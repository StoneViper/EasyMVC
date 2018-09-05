<?php 

namespace framework\database;

/**
 * 数据库类
 */
class Database
{
	protected $_pdo;		// PDO对象
	protected $_table;		// 表名
	function __construct($config)
	{
		// 配置参数
		$dbms = $config['dbms'];
		$host = $config['host'];
		$user = $config['user'];
		$password = $config['password'];
		$dbname = $config['dbname'];
		$port = $config['port'];
		$charset = $config['charset'];
		$this->_table = $config['table'];
		$dsn = "$dbms:host=$host;post=$port;dbname=$dbname;charset=$charset";
		try{
			// 初始化PDO对象
			$this->_pdo = new \PDO($dsn, $user, $password);
		} catch (PDOException $e){
			die ("Error!:" . $e->getMessage() . '<br>');
		}
	}
	/**
	 * 查询所有数据方法
	 * @return array 查询结果
	 */
	public function selectAll()
	{
		$sql = sprintf("SELECT * FROM {$this->_table}");
		$sth = $this->_pdo->prepare($sql);
		$sth->execute();

		return $sth->fetchALL(\PDO::FETCH_ASSOC);
	}
	/**
	 * 条件查询
	 * @param  string $conditional 查询条件
	 * @return array               查询结果
	 */
	public function select($conditional)
	{
		$sql = sprintf("SELECT * FROM {$this->_table} WHERE {$conditional}");
		$sth = $this->_pdo->prepare($sql);
		$sth->execute();

		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
	/**
	 * 按条件删除记录
	 * @param  string $conditional 删除条件
	 * @return integer				   删除条数
	 */
	public function delete($conditional)
	{
		$sql = sprintf("DELETE FROM {$this->_table} WHERE {$conditional}");
		$sth = $this->_pdo->prepare($sql);
		$sth->execute();

		return $sth->rowCount();
	}
	/**
	 * 自定义SQL查询
	 * @param  string $sql SQL语句
	 * @return integer     影响条数
	 */
	public function query($sql)
	{
		$sth = $this->_pdo->prepare($sql);
		$sth->execute();

		return $sth->rowCount();
	}
	/**
	 * 添加数据
	 * @param array $data 数据
	 * @return interger	  影响条数
	 */
	public function add($data)
	{
		$sql = sprintf("INSERT INTO {$this->_table} {$this->formatInsert($data)}");
		
		return $this->query($sql);
	}
	/**
	 * 更新数据
	 * @param  array $data         更新数据
	 * @param  string $conditional 更新条件
	 * @return interger            影响条数
	 */
	public function up($data, $conditional)
	{
		$sql = sprintf("UPDATE {$this->_table} SET {$this->formatUpdate($data)} WHERE ($conditional);");
		
		var_dump($sql);
		return $this->query($sql);
	}
	/**
	 * 格式化插入数据
	 * @param  array $data 数据
	 * @return string      格式语句
	 */
	protected function formatInsert($data)
	{
		$fields = [];
		$values = [];
		foreach ($data as $k => $v) {
			$fields[] = sprintf($k);
			$values[] = sprintf($v);
		}

		$fields = implode(',', $fields);
		$values = implode(',', $values);

		return sprintf("(`{$fields}`) values ('{$values}')");
	}
	/**
	 * 格式化更新数据
	 * @param  array $data 数据
	 * @return string      格式语句
	 */
	protected function formatUpdate($data)
	{
		$values = [];
		foreach ($data as $k => $v) {
			$values[] = sprintf("`".$k. "`='" .$v."'");
		}

		$values = implode(',', $values);

		return sprintf("{$values}");
	}
}