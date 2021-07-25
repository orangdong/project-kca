<x-app-layout>

<div class="row">
    <div class="col">
        <div class="mb-10">
            <label class="required form-label">Barcode</label>
            <input type="number" name="barcode" class="form-control form-control-solid" autocomplete="off" autofocus required />
        </div>
        <div class="mb-10">
            <label class="required form-label">Total Belanja</label>
            <input type="text" name="total_harga" class="form-control form-control-solid" value="<?="Rp".number_format("30000", 0, ".", ".") ?>" disabled required />
        </div>
        <div class="mb-10">
            <label class="required form-label">Metode</label>
            <select class="form-select form-select-solid" aria-label="Select example">
                <option value="tunai">Tunai</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-10">
            <label class="required form-label">Debit</label>
            <input type="number" name="uang_masuk" id="uang_masuk" class="form-control form-control-solid" autocomplete="off" required />
        </div>
        <div class="mb-10">
            <table>
            <tbody>
                <tr>
                    <td>
                    <a class="badge badge-warning" href="#">Uang Pas</a>
                    <a class="badge badge-info" onclick="reset()" href="#">Reset</a>
                    </td>
                    <td>
                    <a class="badge badge-danger" style="color:#ffffff;" onclick="tambah100()" href="#">+ 100K</a>
                    <a class="badge badge-primary" style="color:#ffffff;"  onclick="tambah50()" href="#">+ 50K</a>
                    </td>
                    <td>
                    <a class="badge badge-success" style="color:#ffffff;" onclick="tambah20()" href="#">+ 20K</a>
                    <a class="badge" style="background-color:#5c0099;color:#ffffff;" onclick="tambah10()" href="#">+ 10K</a>
                    </td>
                    <td>
                    <a class="badge" style="background-color:#ab5e00;color:#ffffff;" onclick="tambah5()" href="#">+ 5K</a>
                    <a class="badge" style="background-color:#8f8f8f;color:#ffffff;" onclick="tambah2()" href="#">+ 2K</a>
                    </td>
                    <td>
                    <a class="badge" style="background-color:#014d00;color:#ffffff;" onclick="tambah1()" href="#">+ 1K</a>
                    <a class="badge" style="background-color:#dbdbdb;color:#000000;" onclick="tambah0koma5()" href="#">+ 500</a>
                    </td>
                    <td>
                    <a class="badge" style="background-color:#919191;color:#ffffff;" onclick="tambah0koma2()" href="#">+ 200</a>
                    <a class="badge" style="background-color:#000000;color:#ffffff;" onclick="tambah0koma1()" href="#">+ 100</a>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="mb-10">
            <input type="submit" class="btn btn-dark" value="Checkout"/>
        </div>
    </div>
    <div class="col">
        <div class="table-responsive">
            <div class="">
                <table class="table table-striped table-row-dashed table-row-gray-300 gy-7">
                    <thead>
                        <tr class="fw-bolder fs-6 text-gray-800">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

// Reset
function reset(){
  document.getElementById("uang_masuk").value = 0;
}

// + 100 K
function tambah100(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 100000;
  ;
}

// + 50 K
function tambah50(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 50000;
}

// + 20 K
function tambah20(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 20000;
}

// + 10 K
function tambah10(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 10000;
}

// + 5 K
function tambah5(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 5000;
}

// + 2 K
function tambah2(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 2000;
}

// + 1 K
function tambah1(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 1000;
}

// + 0.5 K
function tambah0koma5(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 500;
}

// + 0.2 K
function tambah0koma2(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 200;
}

// + 0.1 K
function tambah0koma1(){
  var uang_masuk = document.getElementById("uang_masuk").value;
  var uang_masuk1 = uang_masuk * 1;
  document.getElementById("uang_masuk").value = uang_masuk1 + 100;
}
</script>

</x-app-layout>
