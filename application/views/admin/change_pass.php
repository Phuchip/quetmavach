<style>
    th,td {
        padding: 5px 10px;
        border: 1px solid #d2d6de;
        text-align: center;
    }

    table {
        width: 100%;
    }
    .right{
        padding: 15px;
    }
    #add_tags .row_tag .label_tit{
        width: 40%;
        padding-right: 15px;
    }
    #add_tags .row_tag input[type = 'password']{
        width: 60%;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Quản lý tài khoản
            <small>Đổi mật khẩu</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i>Quản lý tài khoản</a></li>
            <li><a href="">Đổi mật khẩu</a></li>
        </ol>
    </section>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body ">
                    <div class="content_search">
                        <form action="" method="POST" id="add_tags" style="width: 100%" class="change_pass">
                            <div class="left"  style="width: 100%; display: flex;">
                                <div class="row_tag">
                                    <label for="" class="label_tit lbl_name_tag"><span>* </span>Mật khẩu cũ</label>
                                    <input type="password" id="password_old" class="name_tag" name="password_old">
                                </div>
                                <div class="row_tag">
                                    <label for="" class="label_tit lbl_name_tag"><span>* </span>Mật khẩu mới</label>
                                    <input type="password" id="password" class="name_tag" name="password">
                                </div>
                                <div class="row_tag">
                                    <label for="" class="label_tit lbl_name_tag"><span>* </span>Nhập lại mật khẩu mới</label>
                                    <input type="password" class="name_tag" name="password_confirmation" id="password_confirmation">
                                </div>
                            </div>
                            <div class="row_tag" style="width: 100%">
                                <input type="submit" name="add_user_admin" class="add_user_admin" value="Cập nhật">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

