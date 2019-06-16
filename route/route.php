<?php


/*Route::group('admin',function (){

});*/
//前台

Route::rule('/','index/index/index','get|post');
Route::rule('gsjj','index/gsjj/index','get|post');
Route::rule('yslx','index/yslx/index','get|post');
Route::rule('yslx_ky','index/yslx/yslx_ky','get|post');
Route::rule('yslx_kcys','index/yslx/yslx_kcys','get|post');
Route::rule('yslx_tlys','index/yslx/yslx_tlys','get|post');
Route::rule('fwln','index/fwln/index','get|post');
Route::rule('contact','index/contact/index','get|post');



//后台




Route::rule('login','admin/login/index','post|get');
Route::rule('logout','admin/login/logout','post|get');

Route::rule('/admin','admin/index/index','get');
Route::rule('welcome','admin/index/welcome','get');
//栏目
Route::rule('cate_lst','admin/cate/cate_lst','get');
Route::rule('cate_add','admin/cate/cate_add','get|post');
Route::rule('cate_edit/:id','admin/cate/cate_edit','get|post');
Route::rule('cate_del','admin/cate/cate_del','get|post');
//文章
Route::rule('article_lst','admin/article/article_lst','get|post');
Route::rule('article_add','admin/article/article_add','get|post');
Route::rule('article_edit/:id','admin/article/article_edit','get|post');
Route::rule('article_del','admin/article/article_del','get|post');
Route::rule('article_upload','admin/article/article_upload','get|post');
Route::rule('article_sort','admin/article/article_sort','get|post');
Route::rule('article_old','admin/article/article_old','get|post');
Route::rule('article_old_del','admin/article/article_old_del','get|post');
Route::rule('article_res','admin/article/article_res','get|post');
//友情链接
Route::rule('link','admin/link/index','post|get');
Route::rule('link_add','admin/link/link_add','get|post');
Route::rule('link_edit/:id','admin/link/link_edit','get|post');
Route::rule('link_del','admin/link/link_del','get|post');
Route::rule('link_sort','admin/link/link_sort','get|post');
//系统
Route::rule('admin_info','admin/admins/admin_info','get|post');
Route::rule('system','admin/system/index','get|post');

//
Route::rule('users_lst','admin/users/users_lst','get|post');

//信息管理
Route::rule('comment_lst','admin/comment/comment_lst','get|post');
Route::rule('comment_see/:id','admin/comment/comment_see','get|post');


