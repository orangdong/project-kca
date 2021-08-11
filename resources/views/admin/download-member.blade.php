<table>
    @php
        $i = 1;
    @endphp
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th>No</th>
            <th>Kode Member</th>
            <th>Nama</th>
            <th>Phone</th>
            <th>Alamat</th>
            <th>NIK</th>
            <th>Email</th>
            <th>Jumlah Orderan</th>
            <th>Total Belanja</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $item)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$item->kode_member}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->phone}}</td>
            <td>{{$item->alamat}}</td>
            <td>{{$item->nik}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->orderans_count}}</td>
            <td>{{$item->orderans_sum_harga_total}}</td>
        </tr>
        @endforeach
    </tbody>
</table>