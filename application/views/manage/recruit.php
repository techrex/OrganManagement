<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom font-cn">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#all" data-toggle="tab">线上报名统计</a></li>
                <li><a href="#add" data-toggle="tab">手动添加报名</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <table id="retable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>班级</th>
                            <th>手机长号</th>
                            <th>手机短号</th>
                            <th class="none">其他社团情况</th>
                            <th class="none">个人简介</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>班级</th>
                            <th>长号</th>
                            <th>短号</th>
                            <th>社团</th>
                            <th>简介</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="tab-pane" id="add">
                    <form id="reform" action="/manage/recruit/add" method="post" role="form">
                        <div class="form-group">
                            <label for="stuid" class="control-label">学号</label>
                            <input type="text" class="form-control" name="stuid" id="stuid" placeholder="请输入学号" data-validation="number_string" data-validation-length="8">
                        </div>
                        <div class="form-group">
                            <label for="realname" class="control-label">姓名</label>
                            <input type="text" class="form-control" name="realname" id="realname" placeholder="请输入姓名" data-validation="required" data-validation-error-msg="请填写姓名">
                        </div>
                        <div class="form-group">
                            <label for="sex" class="control-label">性别</label>
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="sex" value="1" data-validation="required" data-validation-error-msg="请选择性别">男
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="sex" value="2" data-validation="required" data-validation-error-msg="请选择性别">女
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="class" class="control-label">班级</label>
                            <select class="form-control" id="class" name="class" data-validation="required" data-validation-error-msg="请选择班级">
                                <option value="0" selected disabled>请选择班级</option>
                                <option value="1">通信一班</option>
                                <option value="2">通信二班</option>
                                <option value="3">通信三班</option>
                                <option value="4">通信四班</option>
                                <option value="5">通信五班</option>
                                <option value="6">通信六班</option>
                                <option value="7">通信七班</option>
                                <option value="8">通信八班</option>
                                <option value="9">通信九班</option>
                                <option value="10">中英一班</option>
                                <option value="11">中英二班</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mobile_long" class="control-label">手机长号</label>
                            <input type="tel" class="form-control" name="mobile_long" id="mobile_long" placeholder="请输入手机长号" data-validation="number_string" data-validation-length="11">
                        </div>
                        <div class="form-group">
                            <label for="mobile_short" class="control-label">手机短号</label>
                            <input type="tel" class="form-control" name="mobile_short" id="mobile_short" placeholder="请输入手机短号" data-validation="number_string" data-validation-length="6" data-validation-optional="true">
                        </div>
                        <div class="form-group">
                            <label for="otherclub" class="control-label">参加其他社团情况</label>
                            <textarea name="otherclub" class="form-control" id="otherclub" rows="5" placeholder="亲请如实填写哦~" data-validation="required" data-validation-error-msg="没有参加别的社团也请写个无"></textarea>
                            <p style="float: right;color: #8d8d8d;">还可以输入<span id="maxlength1">300</span>字</p>
                        </div>
                        <div class="form-group">
                            <label for="resume" class="control-label">个人简历</label>
                            <textarea name="resume" class="form-control" id="resume" rows="5" placeholder="亲这里可以填特长，经历还有对通信科协的愿景哦~" data-validation="required" data-validation-error-msg="写一下介绍一下自己嘛"></textarea>
                            <p style="float: right;color: #8d8d8d;">还可以输入<span id="maxlength2">300</span>字</p>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submitbtn" class="btn btn-info">提交</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
