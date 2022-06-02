<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="ml-3 row" style="justify-content: space-between;">
            <h4><a href="index.php?controller=baocao">Báo cáo</a></h4>
        </div>
    </div>
</div>
<div class="card-body">
    <fieldset style="border-collapse: collapse;border: 1px solid red" class="ml-5 mr-5">
        <legend class="ml-2">Tìm kiếm</legend>
        <div class="form-group ml-5 row">
            <div class="col-md-4 mb-3">
                <label for="fromDate">Từ ngày</label>
                <input type="date" class="form-control" name="fromDate" id="fromDate" />
            </div>
            <div class="col-md-4 mb-3">
                <label for="toDate">Đến ngày</label>
                <input type="date" class="form-control" name="toDate" id="toDate" />
            </div>
            <div class="col-md-4 mb-3">
                <label for="kho">Kho hàng</label>
                <select class="form-control" id="kho">
                    <?php 
                            foreach($khohang as $item){
                                echo "<option value='$item->id'>".$item->ten."</option>";
                            }
                        ?>
                </select>
            </div>
        </div>
        <div class=" ml-5">
            <button class="btn btn-primary ml-2 mb-3" style="" onclick="selectSearch()"> Tra cứu</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn vị tính</th>
                        <th>Tồn đầu kỳ</th>
                        <th>Tồn cuối kỳ</th>
                        <th>Lượng xuất</th>
                        <th>Lượng nhập</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
            <div style="display: flex;justify-content: right;">
                <ul class="pagination" style="width: fit-content;">
                    <li class="page-item"><a class="page-link" id="Previous" onclick="selectPrevius(this)">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" id="next1" onclick="selectNext1(this)">1</a></li>
                    <li class="page-item"><a class="page-link" id="next2" onclick="selectNext2(this)">2</a></li>
                    <li class="page-item"><a class="page-link" id="next3" onclick="selectNext3(this)">3</a></li>
                    <li class="page-item"><a class="page-link" id="next" onclick="selectNext(this)">Next</a></li>
                </ul>
            </div>
        </div>
        </fieldset>
        <div style="height: 40px;"></div>
                       
</div>

<script>
var take = 9;
var index = 0;
var max = -1;

function selectPrevius(thiz) {
    if (index > 0) {
        index = index - 1;
    }
    Search()


}

function setIndex() {
    if (max < take && max != -1) {
        document.getElementById("next2").style.display = "none";
        document.getElementById("next3").style.display = "none";
    } else if (max < take * 2 && max != -1) {
        document.getElementById("next2").style.display = "block";
        document.getElementById("next3").style.display = "none";
    } else {
        document.getElementById("next2").style.display = "block";
        document.getElementById("next3").style.display = "block";
    }

    if (index == 0) {
        document.getElementById("next1").innerHTML = index;
        document.getElementById("next1").style.backgroundColor = "gray";
        document.getElementById("next2").innerHTML = index + 1;
        document.getElementById("next2").style.backgroundColor = "white";
        document.getElementById("next3").innerHTML = index + 2;
        document.getElementById("next3").style.backgroundColor = "white";
    } else
    if (index > 0 && (index + 1) * take < max) {
        console.log("vao day")
        document.getElementById("next1").innerHTML = index - 1;
        document.getElementById("next1").style.backgroundColor = "white";
        document.getElementById("next2").innerHTML = index;
        document.getElementById("next2").style.backgroundColor = "gray";
        document.getElementById("next3").innerHTML = index + 1;
        document.getElementById("next3").style.backgroundColor = "white";
    } else {
        document.getElementById("next1").innerHTML = index - 2;
        document.getElementById("next1").style.backgroundColor = "white";
        document.getElementById("next2").innerHTML = index - 1;
        document.getElementById("next2").style.backgroundColor = "white";
        document.getElementById("next3").innerHTML = index;
        document.getElementById("next3").style.backgroundColor = "gray";
    }

}

function selectNext1(thiz) {
    index = parseInt(thiz.innerHTML);
    Search()
}

function selectNext2(thiz) {
    index = parseInt(thiz.innerHTML);
    Search()
}

function selectNext(thiz) {
    if (index * take < max && max != -1) {
        index = index + 1;
        
    Search()
    }

}

function selectNext3(thiz) {
    index = parseInt(thiz.innerHTML);
    Search()
}

function selectSearch() {
    index = 0;
    Search()
}




function Search() {
    let fromDate = document.getElementById("fromDate").value;
    let toDate = document.getElementById("toDate").value;
    let kho = document.getElementById("kho").value;
    if (fromDate.length == 0) {
        alert("Bạn cần chọn ngày bắt đầu");
    } else
    if (toDate.length == 0) {
        alert("Bạn cần chọn ngày bắt kết thúc");
    } else if (fromDate > toDate) {
        alert("Ngày bắt đầu phải nhỏ hơn ngày kết thúc");
    } else {
        $('#dataTable tbody').html("");
        fetch("api/baocao.php", {
            method: "POST",
            body: JSON.stringify({
                "fromDate": fromDate,
                "toDate": toDate,
                "kho": kho,
                "index": index,
                "take": take
            })
        }).then(res => res.json()).then(res => {
            console.log(res);
            for (var i = 0; i < res['data'].length; i++) {
                var item = res['data'][i];
                let htmlTemplate = "<tr>"
                htmlTemplate += "<td>" + (i + index * take) + "</td>";
                htmlTemplate += "<td>" + item.TenSP + "</td>";
                htmlTemplate += "<td>" + item.DVT + "</td>";
                htmlTemplate += "<td>" + item.SLDauKy + "</td>";
                htmlTemplate += "<td>" + item.SLCuoiKy + "</td>";
                
                htmlTemplate += "<td>" + item.LuongXuat + "</td>";
                htmlTemplate += "<td>" + item.LuongNhap + "</td></tr>";
                $('#dataTable tbody').append(htmlTemplate);
            }
            max = res['total'];

            setIndex();
        });
    }
}
</script>