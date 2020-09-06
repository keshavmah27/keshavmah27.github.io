<?php
class MY_Model extends CI_Model
{
    function __consruct() {

        parent::__consruct();
    }

    /** Returns Rows based on condition array provided */
    public function countRows($table = NULL, $where = NULL) {

        if ($table == NULL) {

            exit("Table name is required!");
        }

        if ($where == NULL) {

            $query = $this->db->get($table);/** Using CI `get` method */
            return $query->num_rows();/** Return rows */
        } else {

            $query = $this->db->get_where($table, $where);/** Using CI `get_where` method */
            return $query->num_rows();/** Return rows */
        }
    }

    /*

      |

      |  Returns Rows based on columns and condition/s array provided

      |

      | *~~~~~~~PARAMS:~~~~~~~*

      |

      | @$table : table name

      | @columns : if all specifiy "*" else comma separated list of columns "name,email,firstName" etc

      | @conditionArray : array with column names values for their conditions

      | @returnArray : if "true" returns array else object

      |

     */

    public function getRows($table = NULL, $columns = NULL, $where = NULL, $returnArray = NULL, $orderby = null) {

        if ($table == NULL) {

            exit("Table name is required!");
        }

        if ($orderby) {

            $this->db->order_by($orderby);
        }

        if ($where == NULL) {

            if ($columns == "*") {

                $query = $this->db->get($table);/** Using CI `get` method */
            } else {

                $this->db->select($columns)->from($table);

                $query = $this->db->get();
            }

            if ($returnArray == true) {

                return $query->result_array();/** Return rows in array format */
            } else {

                return $query->result();
            }
        } else {

            if ($columns == "*") {

                $query = $this->db->get_where($table, $where);
            } else {

                $this->db->select($columns);

                $this->db->where($where);

                $query = $this->db->get($table);
            }



            // echo $this->db->last_query();

            /** Using CI `get_where` method */
            return $query->result();/** Return rows */
        }
    }

    public function getRowsJoin($table = NULL, $columns = NULL, $where = NULL, $returnArray = NULL, $orderby = null,$join) {

        if ($table == NULL) {

            exit("Table name is required!");
        }

        if($join != null)
        {
            foreach ($join as $key => $value) {
                $this->db->join($key,$value);
            }
        }
        
        if ($orderby) {

            $this->db->order_by($orderby);
        }

        if ($where == NULL) {

            if ($columns == "*") {

                $query = $this->db->get($table);/** Using CI `get` method */
            } else {

                $this->db->select($columns)->from($table);

                $query = $this->db->get();
            }

            if ($returnArray == true) {

                return $query->result_array();/** Return rows in array format */
            } else {

                return $query->result();
            }
        } else {

            if ($columns == "*") {

                $query = $this->db->get_where($table, $where);
            } else {

                $this->db->select($columns);

                $this->db->where($where);

                $query = $this->db->get($table);
            }



            // echo $this->db->last_query();

            /** Using CI `get_where` method */
            return $query->result();/** Return rows */
        }
    }

    public function getAllRows($table = NULL) {
        $result = $this->db->get($table);
        return $result->result();
    }

    public function getSingleRow($table = NULL, $where, $cols = NULL, $orderby = NULL) {
        if ($table == NULL) {

            exit("Table name is required!");
        }

        if ($where == NULL) {

            exit("Condition array is required!");
        } else {

            if ($cols == NULL) {
                if ($orderby) {

                    $this->db->order_by($orderby);
                }
                $query = $this->db->get_where($table, $where);/** Using CI `get_where` method */
                return $query->first_row();/** Return rows */
            } else {
                if ($orderby) {

                    $this->db->order_by($orderby);
                }
                $query = $this->db->select($cols)->where($where)->get($table);

                return $query->first_row();
            }
        }
    }

    /** General Data Insertion function - Returns Inserted Row ID */
    public function insertData($table = NULL, $dataArray = NULL) {

        if ($table == NULL) {

            exit("Table name is required!");
        }

        if ($dataArray == NULL) {

            exit("Data array is required! 1");
        }

        $query = $this->db->insert($table, $dataArray);

        if (!$this->db->insert_id()) {

            return array("error" => $this->db->_error_message());
        }

        return array("insertedRowId" => $this->db->insert_id());
    }

    /** General Data Insertion function - Returns Inserted Row ID */
    public function insertBatchData($table = NULL, $dataArray = NULL) {

        if ($table == NULL) {

            exit("Table name is required!");
        }

        if ($dataArray == NULL) {

            exit("Data array is required! 2");
        }

        $query = $this->db->insert_batch($table, $dataArray);

        return true;
    }

    /** General Data Update function - Returns Inserted Row ID */
    public function updateData($table = NULL, $where = NULL, $dataArray = NULL) {

        if ($table == NULL) {

            exit("Table name is required!");
        }

        if ($where == NULL) {

            exit("Condition array is required!");
        }

        if ($dataArray == NULL) {

            exit("Data array is required!");
        }

        /** If rows or row is found then update it else return false */
        if ($this->countRows($table, $where) > 0) {

            $this->db->where($where);

            $this->db->update($table, $dataArray);

            return array("affectedRows" => $this->db->affected_rows());
        } else {

            return array("error" => "No rows found.");
        }
    }

    public function deleteData($table = NULL, $where = NULL) {

        if ($table == NULL) {

            exit("Table name is required!");
        }

        if ($where == NULL) {

            exit("Condition array is required!");
        }

        $this->db->where($where);

        $this->db->delete($table);



        return true;
    }

    function softDeleteData($table,$where,$dataArray)
    {
        if ($table == NULL) {

            exit("Table name is required!");
        }

        if ($where == NULL) {

            exit("Condition array is required!");
        }

        if ($dataArray == NULL) {

            exit("Data array is required!");
        }

        /** If rows or row is found then update it else return false */
        if ($this->countRows($table, $where) > 0) {

            $this->db->where($where);

            $this->db->update($table, $dataArray);

            return array("affectedRows" => $this->db->affected_rows());
        } else {

            return array("error" => "No rows found.");
        }
    }

    /** General Data mail function - Returns True/false */
    public function mail($fromemail, $from_company_name, $to, $subject, $message) {
        
        $this->load->library('email');
        $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $this->email->from($fromemail, $from_company_name);

        $this->email->to($to);

        $this->email->subject($subject);

        $email_template = $message['email_template'];
        $this->email->message($this->load->view($email_template, $message['resetLink'], TRUE));
        
        if($this->email->send())
        {
            return true;
        }
        else
        {
            die($this->email->print_debugger());
        }
    }

    /** General Data mail function - Returns True/false */
    /* public function mailwithattachment($fromemail, $from_company_name, $to, $subject, $message,$file_name="") {

      //$config = array('mailtype' => 'html');

      //$this->load->library('email', $config);

      $this->email->from($fromemail, $from_company_name);

      $this->email->to($to);

      $this->email->subject($subject);

      $this->email->message($message);

      $this->email->attach($file_name );

      if (!$this->email->send()) {

      die($this->email->print_debugger());

      return false;

      } else {

      return true;

      }

      } */

    /** General Data mail function - Returns True/false */
    public function mailwithattachment($fromemail, $from_company_name, $to, $subject, $message, $file_name = null, $bcc = null) {
        /* echo $fromemail."==".$from_company_name."==".$to."==".$subject."==".$message."==".$bcc;
          die; */
        $config = Array(
            'mailtype' => 'html'
        );
        $this->load->library('email', $config);
        /* $this->load->library('email'); */
        $this->email->initialize($config);

        //$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $this->email->from($fromemail, $from_company_name);
        $this->email->to($to);
        if ($bcc != null) {
            $this->email->bcc($bcc);
        }

        $this->email->subject($subject);
        $this->email->message($message);


        //$file_name = $_SERVER['DOCUMENT_ROOT'].'/assets/upload/pdf/report/accounthistory/AH2.pdf';

        if ($file_name != '') {
            $this->email->attach($file_name);
        }

//        print_r($fromemail);
//        print_r($to);
//        print_r($subject);
//        print_r($message);
//        print_r($bcc);
//        $this->email->send();die;

        if (!$this->email->send()) {
            return $this->email->print_debugger();
        } else {
            return true;
        }
    }

    /*     * *****************

     *

     * @param    string    $columns      coma seprated columns to be select in query

     * @param    Array     $from         From table or Primary table

     * @param    Array     $joins        Array of joins 

     * @param    Array     $conditions   Array of Conditions 

     * 

     * @return    Array    $query->result()    result array

     * 

     * ******************* */

    public function getJoinData($columns, $from, $joins = null, $condition = array(), $groupby = null, $orderby = null, $limit = 0, $offset = 0) {

        $this->db->select($columns);

        $this->db->from($from);

        if (is_array($joins) && !empty($joins)) {

            foreach ($joins as $join) {

                if (isset($join[2])) {

                    $this->db->join($join[0], $join[1], $join[2]);
                } else {

                    $this->db->join($join[0], $join[1]);
                }
            }
        }

        if (is_array($condition) && !empty($condition)) {

            foreach ($condition as $key => $value) {

                if (is_array($value)) {

                    $this->db->where_in($key, $value);
                } else {

                    $this->db->where($key, $value);
                }
            }
        }

        if ($groupby) {

            $this->db->group_by($groupby);
        }

        if ($orderby) {

            $this->db->order_by($orderby);
        }

        if ($limit && $limit > 0) {

            if ($offset && $offset > 0) {

                $this->db->limit($limit, $offset);
            } else {

                $this->db->limit($limit);
            }
        }



        $query = $this->db->get();

        return $query->result();
    }


    public function getDataForDataTable($from, $condition = array(), $orderbyCol = null,$orderby = null ,$limit = 0, $start = 0 , $num_row) {

        if (is_array($condition) && !empty($condition)) {

            foreach ($condition as $key => $value) {

                if (is_array($value)) {

                    $this->db->where_in($key, $value);
                } else {

                    $this->db->where($key, $value);
                }
            }
        }

        if ($orderbyCol) {

            $this->db->order_by($orderbyCol,$orderby);
        }
        if($num_row == 'n'){
            if ($limit && $limit > 0) {

                if ($start && $start > 0) {

                    $this->db->limit($limit, $start);
                } else {

                    $this->db->limit($limit);
                }
            }
        }
        $query = $this->db->get($from);
        if($num_row == 'n')
        {
            if($query->num_rows()>0)
            {
                return $query->result(); 
            }
            else
            {
                return null;
            }
        }
        else
        {
            return $query->num_rows();
        }
    }

    public function getDataForDataTableJoin($from, $condition = array(), $orderbyCol = null,$orderby = null ,$limit = 0, $start = 0 , $num_row, $join = null,$select="*") {

        if($select != null)
        {
            $this->db->select($select);
        }
        if($join != null)
        {
            foreach ($join as $key => $value) {
                $this->db->join($key,$value);
            }
        }
        if (is_array($condition) && !empty($condition)) {

            foreach ($condition as $key => $value) {

                if (is_array($value)) {

                    $this->db->where_in($key, $value);
                } else {

                    $this->db->where($key, $value);
                }
            }
        }

        if ($orderbyCol) {

            $this->db->order_by($orderbyCol,$orderby);
        }
        if($num_row == 'n'){
            if ($limit && $limit > 0) {

                if ($start && $start > 0) {

                    $this->db->limit($limit, $start);
                } else {

                    $this->db->limit($limit);
                }
            }
        }
        $query = $this->db->get($from);
        if($num_row == 'n')
        {
            if($query->num_rows()>0)
            {
                return $query->result(); 
            }
            else
            {
                return null;
            }
        }
        else
        {
            return $query->num_rows();
        }
    }

    public function getById($table,$where)
    {
        $res =  $this->db->select("*")
                 ->from($table)
                 ->where($where)
                 ->get();
        return $res->row();         
    }


     public function getDataForDataTableJoinCustom($from, $condition = array(), $orderbyCol = null,$orderby = null ,$limit = 0, $start = 0 , $num_row, $join = null,$select="*",$groupby) {

        if($select != null)
        {
            $this->db->select($select);
        }
        if($join != null)
        {
            foreach ($join as $key => $value) {
                $this->db->join($key,$value);
            }
        }
        if (is_array($condition) && !empty($condition)) {

            foreach ($condition as $key => $value) {

                if (is_array($value)) {

                    $this->db->where_in($key, $value);
                } else {

                    $this->db->where($key, $value);
                }
            }
        }
         if ($groupby) {

            $this->db->group_by($groupby);
        }

        if ($orderbyCol) {

            $this->db->order_by($orderbyCol,$orderby);
        }
        if($num_row == 'n'){
            if ($limit && $limit > 0) {

                if ($start && $start > 0) {

                    $this->db->limit($limit, $start);
                } else {

                    $this->db->limit($limit);
                }
            }
        }
        $query = $this->db->get($from);
        if($num_row == 'n')
        {
            if($query->num_rows()>0)
            {
                return $query->result(); 
            }
            else
            {
                return null;
            }
        }
        else
        {
            return $query->num_rows();
        }
    }
}