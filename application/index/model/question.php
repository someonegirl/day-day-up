<?php
/**
 * User:goodtimp
 * LastDate:2018/11/21
 */

 namespace app\index\model;
 use think\Model;
 class question extends Model{
   /**
    * 根据分类，得到所有的question
    * @param int $cid
    * @return array arr{Id,categoryId,content,answer,analysis,type}
    */
    public static function get_questions($cid=0){
      $res=($cid==0?db("question")->select():db("question")->where("categoryId",$cid)->select());
      // static $arr=array();
      // $temp_arr=array();
      // foreach($res as $row)
      // {
      //   $temp_arr['Id']=$row['Id'];
      //   $temp_arr['categoryId']=$row['categoryId'];
      //   $temp_arr['content']=$row['content'];
      //   $temp_arr['answer']=$row['answer'];
      //   $temp_arr['analysis']=$row['analysis'];
      //   $temp_arr['type']=$row['type'];
      //   $arr[] = $tmp_arr; 
      // }
      return $res;
    }
    /**
    * 添加question
    * @param array que{Id,categoryId,content,answer,analysis,type}
    */
    public static function add_question($que){
      return db("question")->insertGetId($que);
    }
    /**
   * 根据问题id获取问题
   * @param int $queid
   * @return array {Id,courseId,name,startTime,endTime}
   */
  public static function get_Question($queid = 0)
  {
    //$res = db("question")->where("Id", $queid)->find(1);
    $res = db("question")-find();
    return $res;
  }
  public static function update_question($question_id,$question){
    return db("question")->where("Id",$question_id)->update([
      'content'=>$question["content"],
      'answer'=>$question["answer"]
    ]);
  }
 }