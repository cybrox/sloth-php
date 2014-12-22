<?php 


class Query extends Builder {

  public $table;
  public $connection;
  public $fetch_class = 'StdClass';
  public $columns = array();
  public $join = array();
  public $where = array();
  public $sortby = array();
  public $groupby = array();
  public $limit;
  public $offset;
  public $bind = array();


  /**
   * Create a new database query instance for chaining
   * @param string $table - The name of the table to access
   * @param object Connector - A db connector
   */
  public static function table($table, $connection = null) {
    return new static($table, $connection);
  }


  /**
   * Create a new database query instance
   * @param string $table - The name of the table to access
   * @param object Connector - A db connector
   */
  public function __construct($table, $connection = null) {
    if(is_null($connection)) $connection = Database::connection();

    $this->table = $table;
    $this->connection = $connection;
  }


  /**
   * Set the class name for fetch queries, return self for chaining
   * @param string $class - The respective fetch class
   */
  public function apply($class) {
    $this->fetch_class = $class;

    return $this;
  }


  /**
   * Run a count function on database query
   * @return string
   */
  public function count() {
    list($result, $statement) = Database::execute($this->build_select_count(), $this->bind);

    return $statement->fetchColumn();
  }


  /**
   * Fetch a single column from the query
   * @param array $columns - The columns to fetch
   * @param int $column_number - The column number to fetch
   * @return string
   */
  public function column($columns = array(), $column_number = 0) {
    list($result, $statement) = Database::execute($this->build_select($columns), $this->bind);

    return $statement->fetchColumn($column_number);
  }

  /**
   * Fetch a single row from the query
   * @param array $columns - The columns to fetch
   * @return object
   */
  public function fetch($columns = null) {
    list($result, $statement) = Database::execute($this->build_select($columns), $this->bind);

    $statement->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->fetch_class);

    return $statement->fetch();
  }


  /**
   * Fetch a result set from the query
   * @param array $columns - The columns to fetch
   * @return object
   */
  public function get($columns = null) {
    list($result, $statement) = Database::execute($this->build_select($columns), $this->bind);

    $statement->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->fetch_class);

    return $statement->fetchAll();
  }


  /**
   * Insert a row into the database
   * @param array $row - Rows to insert into the database
   * @return object
   */
  public function insert($row) {
    list($result, $statement) = Database::execute($this->build_insert($row), $this->bind);

    return $statement->rowCount();
  }


  /**
   * Insert a row into the database and return the inserted ID
   * @param array $row - Rows to insert into the database
   * @return int
   */
  public function insert_get_id($row) {
    list($result, $statement) = Database::execute($this->build_insert($row), $this->bind);

    return $this->connection->instance()->lastInsertId();
  }


  /**
   * Update row in the database
   * @param array $row - Rows to update in the database
   * @return int
   */
  public function update($row) {
    list($result, $statement) = Database::execute($this->build_update($row), $this->bind);

    return $statement->rowCount();
  }


  /**
   * Delete a row in the database
   * @return int
   */
  public function delete() {
    list($result, $statement) = Database::execute($this->build_delete(), $this->bind);

    return $statement->rowCount();
  }


  /**
   * Add a where clause to the query
   * @param array $columns - The columns to match
   * @param string $operator - The operator for the column comparison action
   * @param string $value - The value to compare the column against
   * @return object
   */
  public function where($column, $operator, $value) {
    $this->where[] = (count($this->where) ? 'AND ' : 'WHERE ') .
      $this->wrap_column($column) . ' ' . $operator . ' ?';

    $this->bind[] = $value;

    return $this;
  }


  /**
   * Add a where clause to the query starting with OR
   * @param array $columns - The columns to match
   * @param string $operator - The operator for the column comparison action
   * @param string $value - The value to compare the column against
   * @return object
   */
  public function or_where($column, $operator, $value) {
    $this->where[] = (count($this->where) ? 'OR ' : 'WHERE ') .
      $this->wrap_column($column) . ' ' . $operator . ' ?';

    $this->bind[] = $value;

    return $this;
  }


  /**
   * Add a where clause to the query starting with IN
   * @param array $columns - The columns to match
   * @param array $values - The array of matching values
   * @return object
   */
  public function where_in($column, $values) {
    $this->where[] = (count($this->where) ? 'OR ' : 'WHERE ') .
      $this->wrap_column($column) . ' IN (' . $this->placeholders(count($values)) . ')';

    $this->bind = array_merge($this->bind, $values);

    return $this;
  }


  /**
   * Add a table join to the query
   * @param string|function $table - Table name string or function
   * @param string $left - Left join parameter
   * @param string $operator - Join operator
   * @param string $right - Right join parameter
   * @param string $type - Join type
   * @return object
   */
  public function join($table, $left, $operator, $right, $type = 'INNER') {
    if($table instanceof Closure) {
      list($query, $alias) = $table();

      $this->bind = array_merge($this->bind, $query->bind);

      $table = '(' . $query->build_select() . ') AS ' . $this->wrap_column($alias);
    }
    else $table = $this->wrap_table($table);

    $this->join[] = sprintf('%s JOIN %s ON (%s %s %s)',
      $type, $table, $this->wrap_column($left), $operator, $this->wrap_column($right));

    return $this;
  }


  /**
   * Add a left table join to the query
   * @param string $table - Table name string
   * @param string $left - Left join parameter
   * @param string $operator - Join operator
   * @param string $right - Right join parameter
   * @return object
   */
  public function left_join($table, $left, $operator, $right) {
    return $this->join($table, $left, $operator, $right, 'LEFT');
  }


  /**
   * Add a sort by column to the query
   * @param string $column - The column to match
   * @param string $mode - The sort mode for this column
   * @return object
   */
  public function sort($column, $mode = 'ASC') {
    $this->sortby[] = $this->wrap_column($column) . ' ' . strtoupper($mode);

    return $this;
  }


  /**
   * Add a group by column to the query
   * @param string $column - The column to match
   * @return object
   */
  public function group($column) {
    $this->groupby[] = $this->wrap_column($column);

    return $this;
  }


  /**
   * Set a row limit on the query
   * @param int $num - Limit of rows returned
   * @return object
   */
  public function take($num) {
    $this->limit = $num;

    return $this;
  }


  /**
   * Set a row offset on the query
   * @param int $num - Offset for limit of rows returned
   * @return object
   */
  public function skip($num) {
    $this->offset = $num;

    return $this;
  }

}