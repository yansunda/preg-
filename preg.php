<?php
/**
 * Created by phpStrom.
 * User: yansunda
 * Date: 2019/6/23
 * Time: 21:10
 * Version 1.0
 * Email : yansunda@myhexin.com
 *       : 819035995@qq.com
 * 学习链接地址：①https://v.youku.com/v_show/id_XMTc5MjQ3ODA4.html?refer=seo_operation.liuxiao.liux_00003310_3000_nUF3ai_19042900
 *               ②https://v.youku.com/v_show/id_XMTc5MjQzMTM2.html?spm=a2h0j.11185381.listitem_page1.5!2~A
 * Desc :正则表达式学习
 * 开始和结尾用定界符，我们一般用“/“声明为定界符，没有特殊说明就用”/“
 * 正则表达式主要的组成部分
 * 1、原子：
 *   ①当个字符情况：字符a-z、A-Z、0-9、%@
 *   ②模式单元：多个字符情况：字符(abc)加上括号来区分
 *   ③原子表 [xcy]  字符必须从里面选
 *   ④重新使用牧师单元：＼＼1、＼＼2、＼＼3
 *   ⑤普通转义字符：
 *              ＼d（匹配数字）、＼D（匹配除数字之外的字符）、
 *               ＼w（匹配大小写字母、数字、下划线）、＼W（匹配除了大小写字母、数字下划线之外的字符）
 *               ＼s（匹配任何空白字符，包括空格、制表符、换页符等，等价于【\f\n\r\t\v】）、＼S (匹配任何除了空格、制表符、换页符【\f\n\r\t\v】)之外的字符
 * 下划线之外的的字符）、
 *   ⑥转义原字符：＼？、＼+（普通问号和普通加号）
 *   例子：
 *        '/a\d/' a字母后面只要接上数字就匹配上
 *        '/a\D/' a字母后面只要除了数字就匹配上
 *        '/a\w/' a字母后面只要字母大小写、数字、下划线就匹配上
 *        '/a\s/' a字母后面只要接上空格、换行符或者上述说的符号就可以匹配上
 *        '/a\S/' a字母后面只要接上除了空格、换行符或者上述说的符号就可以匹配上
 * 2、元字符：包括有特殊功能的字符 ？、+、*、$、^、
*          ①字符串边界限制
 *              '/^abc/'、'/\Aabc/'、(以abc开头的字符串匹配上)
 *              '/abc$/'、'/abc\Z/' (以abc结尾的字符串匹配上)
 *         ②单词边界限制
 *              '/\babc' 匹配单词以abc开头的字符。也可以将\b放到后面但是匹配结尾的字符串
 *              '/\Babc' 匹配含有abc但是不以abc开头的字符串，同样也可以放到最后
 *          ③重复匹配
 *              '/ab?$/' 匹配0次或者一次a字符后面接上b字符
 *              '/ab*$/' 匹配大于或等于0次a字符后面接上b字符
 *              '/ab+$/' 匹配大于或者等于1次字符后面接上b字符
 *          ④匹配任何一个字符，除了换行符\n、\r\n
 *              '/a.*c$/' 匹配a后面接上任意多个任意字符，并以c结尾的字符
 *           ⑤指定重复出现的次数
 *              .'/ab{2}c$/' 匹配在a后面b要出现2次，并以c结尾的字符
 *               '/ab{2,3}c$/' 匹配在a后面要出现2-3次b，并以c结尾    表示下限和上限
 *               '/ab{2,}c$/'  陪陪a后买你出现2次或者2次以上的b，并以c结尾  没有上限
 *                指定匹配次数可以表示前面的?、*、+
 *           ⑥原子表
 *                '/ab[x,y,z]c$/' ab字符串后面接上x、y、z中的一个字符并以c结尾
 *                '/ab[^x,y,z]c$/' ab字符串后面接上除了x、y、z中的一个字符并以c结尾的的字符串
 *                '/ab[x-z]c$/' ab字符串后面接上除了x、y、z中的一个字符串并以c结尾的字符串
 *                '/ab[a-zA-Z]c$/'
 *           ⑦模式选择符 \
 *                 '/^hello world|earth/' 匹配hello world开头的字符。和匹配字符中含有earth的字符串。“\”将这两个字符分割成两个正则表达式，只要符合这两个正则表达式，就可以匹配上
 *           ⑧模式单元 ()
 *                  '/^hello (world|earth)$/' 匹配hello world 或者 hello earth字符串
 *           ⑨重新使用的模式单元  /1,/2,/3
 *              '/^\d{4}([-\/])\d{2}\\1\d{2}$/'    类似2019-06-26或者2019/06/26，重新使用模式单元匹配的是你之前用的是什么，那么后面的内容也是相同的
 *              '/a(\d)b\\1/' 前面匹配到\d后面也要匹配到\d
 * 3、模式修饰符：对正则表达式的语义的修正  在定界符的外面进行添加
 *              ①i可以同时匹配大小写字母
 *                  '/abc/i'  abc不区分大小写
 *              ②x忽略空白
 *              ③U匹配最近的字符串
 *    二：PHP正则表达式详解
 *       ① preg_match($preg, $str, $arr)//匹配正则表达式，并匹配到第一个元素赋值给$arr
 *              $preg = '/a\d/';
 *              $str = 'aa a3j';
 *              $is_preg = preg_match($preg, $str, $arr);//$arr的值为[a3]，只匹配到第一个元素，不会往后继续匹配了
 *       ②增加模式单元,可以匹配到以第一个子组
 *               $preg = '/a(\d)/';
 *               $str = 'a1 aaj';
 *               $is_preg = preg_match($preg, $str, $arr);//$arr的值为[a3, 3]
 *       ③preg_match_all,匹配所有的的元素和子组
 *              $preg = '/a(\d)/';
 *              $str = 'a1 a4a8';
 *              $is_preg = preg_match_all($preg, $str, $arr);//$arr的值为[[a1,a4,a8],[1,4,8]]
 *      ④取出一个字符串中所有的年月日，并进行分类
 *              $preg = '/(\d{4})-(\d{1,2})-(\d{1,2})/';
 *              $str = '今天是2019-07-1,明天是2019-07-02';
 *              $is_preg = preg_match_all($preg, $str, $arr);//arr的值为[[2019-07-01,2019-07-02],[2019,2019],[07,07],[1,02]]
 *     ⑤$date的月、日、am或者pm
 *              $date = date("Y-m-d H:i a", time());
 *              $preg = "/\d{4}-(\d{1,2})-(\d{1,2}) \d{1,2}:\d{1,2} ([a,p]m)/";
 *              $count = preg_match_all($preg, $date, $arr);
 *              var_dump($date,$count, $arr);die;
 *     ⑥模式修正符匹配正则
 *              //匹配html标签
 *              $html = "<h1>你好</h1><b>hello</br>";
 *              $preg = "/<.*>/U";//模式修正符：匹配最近的标签，并且重复匹配
 *              $count = preg_match_all($preg, $html, $arr);
 *              var_dump($count,$html,$arr);die;
 *      ⑦preg_grep :返回给定数组元素和正则表达式相匹配的元素组成的数组
 *              1)匹配一个数组中，第一个是字母，第二个是数字的元素
 *                 $arr = ['a1','aaa2a','b3','aaa','c0','o9','cbas','a7b'];
 *                 $preg = "/^[a-z]\d$/i";
 *                 $get = preg_grep($preg, $arr);//[a1,b3,c0,o9]
 *      ⑧preg_split：正则表达式对字符串进行拆分
 *              1)$str  = "today is pragram,day ";
 *                $preg = "/ |,/s";
 *                $arr = preg_split($preg, $str);//匹配空格和“，”,结果为['today','is','pragram','day','']
 *              2)有时可以和array_count_values结合起来使用，用来统计数组中元素出现的次数
 *              3)preg_split($preg, $str, 2);//最多拆分两个，结果为['today','ispragram,day ']
 *              4)preg_split($preg, $str, 0, PREG_SPLIT_NO_EMPTY)//返回的数组没有空格，['today','is','pragram','day']
 *              5)$str  = "today4a1is9ba3pra3gram6,day ";
 *                $preg = "/a(\d)/";
 *                $arr = preg_split($preg, $str, 0, PREG_SPLIT_DELIM_CAPTURE);//正则表达式中括号的内容被匹配也会捕获到数组里面,结果为['today4','1','is9b','3','pr','3','gram6,day ']
 */
$str  = "today4a1is9ba3pra3gram6,day ";
$preg = "/a(\d)/";
$arr = preg_split($preg, $str, 0, PREG_SPLIT_DELIM_CAPTURE);
var_dump($arr);
