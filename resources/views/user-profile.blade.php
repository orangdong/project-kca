@extends('layouts.app')
@section('isi_halaman')
	<!-- begin::Card -->
	<div class="card">
	 

									<!--begin::Card body-->
									<div class="card-body p-9">
										<!--begin::Row-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Full Name</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
												<span class="fw-bolder fs-6 text-dark">{{$user->name}}</span>
											</div>
											<!--end::Col-->
										</div>
										<!--end::Row-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Username</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8 fv-row">
												<span class="fw-bold fs-6">{{$user->username}}</span>
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Phone
											<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i></label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8 d-flex align-items-center">
                                                <span>
                                                    <form action="" method="post">
                                                        <input type="number" name="barcode" class="form-control form-control-solid" value="{{$user->phone}}" />
                                                        <br><a type="submit" class="badge badge-success" >Edit</a>
                                                    </form>
												</span>
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Password Lama</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
                                                <form action="" method="post">
                                                    <input class="form-control form-control-lg form-control-solid" type="password" name="password_lama" required autocomplete="current-password" />
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Password Baru</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
                                                <input class="form-control form-control-lg form-control-solid" type="password" name="password_baru" required autocomplete="current-password" />
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Konfirmasi Password Baru</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
												    <input class="form-control form-control-lg form-control-solid" type="password" name="password_baru_confirm" required autocomplete="current-password" />
                                                    <br><a type="submit" class="badge badge-danger" >Ganti Password</a>
                                                </form>
                                            </div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Card body-->
	</div>
@endsection('isi_halaman')