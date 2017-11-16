<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix'=>''],function (){
    Route::get('/','IndexController@index');
    Route::get('tnqs','IndexController@tnqs');
    Route::get('shmz','IndexController@shmz');
    Route::get('jyjx','IndexController@jyjx');
    Route::get('jl','IndexController@jl');
    Route::get('zz','IndexController@zz');
});
Route::get('sms/{phoneNum}', 'SignController@sms');//获取手机验证码
Route::get('kit/captcha/{tmp}', 'KitController@captcha');//获取验证码
Route::match(['get', 'post'],'login','SignController@login');//登陆
Route::match(['get', 'post'],'register','SignController@register');//注册
Route::get('logout','SignController@logout')->middleware('logged');//退出
Route::get('verification/{yzm}','SignController@verification')->middleware('logged');//验证验证码

//用户
Route::group(['prefix'=>'user'],function (){
    Route::get('{uid}','UserController@index')->where('uid', '[0-9]+');//用户主页
    Route::match(['get','post'],'edit','UserController@edit')->middleware('logged');//用户编辑个人资料
    Route::match(['get','post'],'changeheadimg','UserController@changeheadimg')->middleware('logged');//用户修改头像
    Route::match(['get','post'],'modifyPassword','UserController@modifyPassword')->middleware('logged');//修改密码
});
//日记
Route::group(['prefix' => 'diary'], function () {
    Route::get('{uid}/index', 'DiaryController@index');//查看用户所有日记
    //用户本人才能进行的操作
    Route::get('{diary_id}/detail', 'DiaryController@detail');//查看用户日记内容
    Route::match(['get', 'post'],'create', 'DiaryController@create')->middleware('logged');//用户创建日记
    Route::match(['get', 'post'],'{diary_id}/edit', 'DiaryController@edit')->middleware('logged');//修改日记
    Route::get('{diary_id}/delete', 'DiaryController@delete')->middleware('logged');//删除日记
});
//重要日子
Route::group(['prefix' => 'imp_date'], function () {
    Route::get('index', 'ImportantDateController@index')->middleware('logged');//查看用户重要日子
    Route::match(['get', 'post'],'create', 'ImportantDateController@create')->middleware('logged');//用户创建重要日子
    Route::match(['get', 'post'],'{impdate_id}/edit', 'ImportantDateController@edit')->middleware('logged');//修改日子
    Route::get('{impdate_id}/delete', 'ImportantDateController@delete')->middleware('logged');//删除日子
});
//文章
Route::group(['prefix'=>'article'],function (){
    Route::get('{uid}/all','ArticleController@index');//用户个人文章列表
    Route::match(['get','post'],'{cat_id}/create','ArticleController@create');//创建文章
    Route::get('{art_id}/detail','ArticleController@detail');//查看文章详细内容
    Route::get('{art_id}/delete','ArticleController@delete')->middleware('logged');//删除文章
    Route::match(['get','post'],'{article_id}/edit','ArticleController@edit')->middleware('logged');//修改文章
});
//关注
Route::group(['prefix'=>'follow'],function () {
    Route::get('{uid}/followers','FollowController@followers');//获取用户关注者
    Route::get('{uid}/fans','FollowController@fans');//获取用户粉丝
    Route::get('{follower_id}/follow','FollowController@follow')->middleware('logged');//执行关注操作
    Route::get('{canceler_id}/cancel','FollowController@cancel')->middleware('logged');//执行取关操作
});
//私信
Route::group(['prefix'=>'private_letter'],function () {
    Route::get('{pri_let_id}/detail','PrivateLetterController@detail')->middleware('logged');//查看私信内容
    Route::post('{to_user_id}/send','PrivateLetterController@send')->middleware('logged');//发私信
    Route::get('all','PrivateLetterController@all')->middleware('logged');//私信列表
    Route::get('{pri_let_id}/delete','PrivateLetterController@delete')->middleware('logged');//删除私信
});
//评论
Route::group(['prefix'=>'comment'],function () {
        Route::post('{article_id}/publish','CommentController@publish')->middleware('logged');//发表评论
        Route::get('{comment_id}/delete','CommentController@delete')->middleware('logged');//删除评论
});
//相册
Route::group(['prefix'=>'album'],function (){
    Route::get('{uid}/all','AlbumController@all');//查看所有相册
    Route::post('create','AlbumController@create')->middleware('logged');//创建相册
    Route::get('{album_id}/delete','AlbumController@delete')->middleware('logged');//删除相册
    Route::post('{album_id}/edit','AlbumController@edit')->middleware('logged');//修改相册
});
//照片
Route::group(['prefix'=>'picture'],function (){
    Route::get('{album_id}/all','PictureController@all');//查看所有相册
    Route::post('{album_id}/create','PictureController@create')->middleware('logged');//创建相册
    Route::get('{picture_id}/delete','PictureController@delete')->middleware('logged');//删除相册
});







Route::get('test',function (){//测试专用
    return view('test');
});
Route::get('test1',function (){//测试专用
    return view('test1')->with('user',session('logged_user'));
});
//Route::any('qnupload','QiniuUploadController@postDoupload');