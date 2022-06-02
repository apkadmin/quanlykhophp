<script>
    $(document).click(function () {

    });

    $('#btnThemSanPham').click(function() {
        // debugger;
        // Lấy thông tin Sản phẩm
        if ($('#sp_ma option:selected').text()==''){
            alert('Bạn cần chọn sản phẩm trước');
        }
        else {
        var sp_ma = $('#sp_ma').val();
        var sp_gia = $('#sp_ma option:selected').data('sp_gia');
        var sp_sl = $('#sp_ma option:selected').data('sp_sl');
        var sp_ten = $('#sp_ma option:selected').text();
        var soluong = $('#soluong').val();
            if (soluong.length == 0 || parseFloat(soluong) <= 0){
                alert("Số lượng phải lớn hơn 0");
            } else if (soluong > sp_sl){
                alert("Số lượng đang vượt quá số lượng hiện có " + sp_sl);
            } else {
                var thanhtien = (soluong * sp_gia);
        var itemId = generateUUID();
        // Tạo mẫu giao diện HTML Table Row
        var htmlTemplate = '<tr id='+itemId+'>';
        htmlTemplate += '<td>' + sp_ten + '<input type="hidden" name="sp_ma[]" value="' + sp_ma + '"/></td>';
        htmlTemplate += '<td>' + soluong + '<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '"/></td>';
        htmlTemplate += '<td>' + sp_gia + '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '"/></td>';
        htmlTemplate += '<td>' + thanhtien + '<input type="hidden" name="sp_dh_sl[]" value="' + sp_sl + '"/></td>';
        htmlTemplate += '<td><button type="button" class="btn btn-danger btn-delete-row" onClick="removeItem(this, '+thanhtien+')" >Xóa</button></td>';
        htmlTemplate += '</tr>';

        // Thêm vào TABLE BODY
        $('#tblChiTietDonHang tbody').append(htmlTemplate);
        $('#total').html(parseFloat($('#total').html()) + thanhtien)

        // Clear
        $('#sp_ma').val('');
        $('#soluong').val('');
            }
        
        }
        
    });

    function removeItem(thiz, value){
        $('#total').html(parseFloat($('#total').html()) - value)
        thiz.parentNode.parentNode.remove();
    }

    $('#btnThemSanPhammua').click(function() {
            var sp_ma = $('#productId').val();
            var sp_gia = $('#gia').val();
            var dvt = $('#donvi').val();
            var dvtId = $('#dvtId').val();
            var sp_ten = $('#tensp').val();
            var soluong = $('#soluong').val();
            var thanhtien = (soluong * sp_gia);
            var makho = $('#kho').val();
            var soluongOld = $('#soluongOld').val();

            if(sp_ten.length == 0) {
                alert("Bạn cần nhập tên sản phẩm");
            } else if(sp_gia.length == 0 || sp_gia == 0){
                alert("Bạn cần nhập giá sản phẩm");
            } else if (dvt.length == 0){
                alert("Bạn cần điền đơn vị tính");
            } else if (soluong.length == 0|| soluong == "0"){
                alert("Bạn cần nhập số lượng sản phẩm");
            } else {
            // Tạo mẫu giao diện HTML Table Row
            var htmlTemplate = '<tr>';
            htmlTemplate += '<td>' + sp_ten + '<input type="hidden" name="sp_ma[]" value="' + sp_ma + '"/></td>';
            htmlTemplate += '<td>' + soluong + ' ('+ dvt +')<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '"/></td>';
            htmlTemplate += '<td>' + sp_gia + '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '"/></td>';
            htmlTemplate += '<td>' + thanhtien + '</td>';
            htmlTemplate += '<td><button type="button" class="btn btn-danger btn-delete-row"  onClick="removeItem(this, '+thanhtien+')"" >Xóa</button></td>';
            htmlTemplate += '</tr> <input type="hidden" name="sp_dh_dvt[]" value ="'+dvtId+'"/>  <input type="hidden" name="sp_dh_dvt_name[]" value ="'+dvt+'"/> <input type="hidden" name="sp_dh_kho[]" value ="'+makho+'"/> <input type="hidden" name="sp_dh_soluongold[]" value ="'+soluongOld+'"/>  <input type="hidden" name="sp_dh_spten[]" value ="'+sp_ten+'"/>';

            // Thêm vào TABLE BODY
            $('#tblChiTietDonHang tbody').append(htmlTemplate);
            $('#total').html(parseFloat($('#total').html()) + thanhtien)
            $('#sp_ma').val('');
            $('#soluong').val('0');
            }
    });
    $('#chiTietDonHangContainer').on('click', '.btn-delete-row', function() {
        // Ta có cấu trúc
        // <tr>
        //    <td>
        //        <button class="btn-delete-row"></button>     <--- $(this) chính là đối tượng đang được người dùng click
        //    </td>
        // </tr>

        // Từ nút người dùng click -> tìm lên phần tử cha -> phần tử cha
        // Xóa dòng TR
        $(this).parent().parent()[0].remove();
    });
</script>