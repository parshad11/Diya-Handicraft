@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Contact Mails</h1>
                    <small>Manage Your mails From Here</small>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="tab-pane show active" id="e_departments">
            <div class="table-responsive">
                <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Contact Name</th>
                        <th>Contact E-mail</th>
                        <th>Contact Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr class="text-center">
                            <td>{{$loop->index+1}}</td>
                            <td>
                                <div class="font-15">{{ucfirst($contact->name)}}</div>
                            </td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->address}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-default" title="View" data-toggle="modal"
                                   onclick="clientView('{{$contact->id}}','{{$contact->name}}','{{$contact->email}}','{{$contact->subject}}','{{$contact->address}}','{{$contact->message}}','{{$contact->phone}}')"><i
                                            class="fa fa-eye"></i>
                                </a>
                                <form id="deleteContact"
                                      action="{{route('contacts.delete',['id'=>base64_encode($contact->id)])}}"
                                      method="Post">
                                    @csrf
                                    <a href="#" id="contactDelete"
                                       class="btn btn-sm btn-default js-sweetalert" title="Delete"
                                       data-type="confirm"><i class="fa fa-trash-o text-danger"></i></a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    {{--View Modal--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         id="contactView"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Message Detail of <span id="title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="name" class="font-weight-bold">Client Name:</label>
                            <span id="clientName"></span>
                        </div>
                        <div class="col-6">
                            <label for="email" class="font-weight-bold">Client E-mail:</label>
                            <span id="clientEmail"></span>
                        </div>
                        <div class="col-6">
                            <label for="subject" class="font-weight-bold">Subject:</label>
                            <span id="subject"></span>
                        </div>
                        <div class="col-6">
                            <label for="address" class="font-weight-bold">Address:</label>
                            <span id="address"></span>
                        </div>
                        <div class="col-6">
                            <label for="phone" class="font-weight-bold">Phone:</label>
                            <span id="clientPhone"></span>
                        </div>
                        <div class="col-12 text-center">
                            <label for="message" class="font-weight-bold">Message:</label>
                            <br>
                            <span id="clientMessage"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Modal--}}
@endsection
@push('scripts')
    <script src="{{asset('backend/html/assets/js/pages/tables/jquery-datatable.js')}}"></script>
    <script>
        $('.dataTable').dataTable({searching: false});
    </script>
    <script>
        function clientView(id, name, email, subject, address, message, phone) {
            $('#contactView').modal('show');
            $('#clientName').html(name);
            $('#clientEmail').html(email);
            $('#subject').html(subject);
            $('#address').html(address);
            $('#clientMessage').html(message);
            $('#title').html(name);
            if (phone != '') {
                $('#clientPhone').html(phone)
            } else {
                $('#clientPhone').html('N/A');
            }

        }

        $('#contactDelete').click(function (e) {
            e.preventDefault();
            swal({
                    title: "Are You Sure!",
                    text: "Would you like to Delete item?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                },
                function (isConfirm) {
                    if (isConfirm) {
                        document.getElementById('deleteContact').submit();
                    }
                }
            )
        });
    </script>

@endpush