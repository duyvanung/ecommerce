@extends('layouts.master')

@section('title','Chính sách bảo hành')

@section('content')

<div class="container">
    <div class="tk-desc">
        <h2>Chi tiết các gói bảo hành</h2>
        <div class="dst-sdesc">pnt, Thứ Tư, 06/11/2019
            <div class="dst_scls">
                <div id="fb-root" class=" fb_reset">
                    <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
                        <div></div>
                    </div>
                </div>
                <div class="fb-like" data-href="https://didongthongminh.vn/huong-dan-mua-hang/chinh-sach-chung/chi-tiet-cac-goi-bao-hanh" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
            </div>
            <span class="xu-xem">83589 lượt xem</span></div>
        <div class="news-exc">
            <p style="font-weight: 400;"><b><strong>Lời cảm ơn:</strong></b></p>
            <ul>
                Cảm ơn quý khách đã tin tưởng và mua hàng tại WooMobile. Trong quá trình hình thành và phát triển, WooMobile luôn lấy bảo hành, hậu mãi làm gốc rễ. Ngoài những sản phẩm được phân phối chính hãng tại Việt Nam được bảo hành theo chính sách chung của từng hãng, các sản phẩm do WooMobile nhập khẩu, các sản phẩm qua sử dụng sẽ được bảo hành theo chính sách riêng của WooMobile.</li>
            </ul>
            <p style="font-weight: 400;"><b><strong>Điều khoản bảo hành:</strong></b></p>
            <ul style="font-weight: 400;">
                <li>Để được đổi mới trong thời hạn quý khách cần giữ gìn máy, phụ kiện không xước, móp, hộp không rách, dán băng keo.</li>
                <li>Máy trong thời hạn bảo hành, tem, phiếu bảo hành còn nguyên vẹn và hợp lệ, không có dấu hiệu tẩy xóa.</li>
                <li>Công ty không chịu trách nhiệm về hình thức máy, thiếu phụ kiện, dính tài khoản icloud, google account sau khi khách rời cửa hàng.</li>
                <li>Khách hàng muốn trả lại máy trong thời gian đổi trả sẽ bị chiết khấu từ 10-20% tùy sản phẩm, hỗ trợ nhập lại máy theo giá thỏa thuận để lên đời.</li>
                <li>Nếu quá thời hạn mà không xử lý được, hoặc máy bị bảo hành lại quá 2 lần: Quý khách sẽ được đổi main hoặc đổi máy tương đương.</li>
                <li>Quý khách được hỗ trợ cài đặt phần mềm, tải game/app, vệ sinh, lau bụi cho máy trọn đời.</li>
                <li>Không bảo hành các lỗi phát sinh do già hóa linh kiện: điểm chết, đốm sáng, sọc kẻ màn hình, ố vàng ngoài thời gian đổi mới quy định của từng gói bảo hành.</li>
                <li>Không bảo hành màn hình đối với trường hợp màn hình có dưới 5 điểm chết</li>
                <li>Không bảo hành đối với lỗi màn chảy mực. Dấu hiệu nhận biết màn chảy mực: có các vệt loang màu tím ở các góc, đốm đen màn, màn sọc đen hoặc tím, có loang dầu khi nhìn nghiêng.</li>
                <li>Không bảo hành với máy vào nước với cả sản phẩm có khả năng chống nước, vui lòng không lạm dụng tính năng này.</li>
            </ul>
        </div>
    </div>
</div>

@endsection


@section('css')

<style type="text/css">
.dst-sdesc {
    line-height: 1.7;
    color: red;
    border-bottom: 1px dashed #e2e2e2;
    padding-bottom: 10px;
    margin-bottom: 15px;
}
.dst_scls {
    margin-left: 5px;
    vertical-align: top;
    display: inline-block;
}
.xu-xem {
    color: #999;
    margin-left: 5px;
}
.xu-xem:before {
    content: "\f06e";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
    color: #bbb;
    font-size: 13px;
    padding-right: 0.5em;
    top: 10px;
    left: 0;
}
</style>

@endsection
