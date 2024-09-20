@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
<h5 class="card-header">Chi tiết đơn hàng <a href="" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Generate PDF</a>
  </h5>
  <div class="card-body">
   
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Id</th>
          <th>Tên sản phẩm</th>
          <th>Giá</th>
          <th>Số Lượng</th>
          <th>Thành tiền</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orderdetails as $key=>$item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->product->title }}</td>
            <td>{{ number_format($item->product->price),2 }} VNĐ</td>
            <td>{{ $item->soluong }}</td>
            <td>{{ number_format($item->thanhtien),2 }} VNĐ</td>
        </tr>
        @endforeach
      </tbody>
    </table>
   

  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
