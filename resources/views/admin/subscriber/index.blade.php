@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
      <section class="section">
        <div class="section-header">
          <h1>Subscribers</h1>
        </div>

        <div class="section-body">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Send Email to all subscribers</h4>
                </div>
                <div class="card-body">
                 <form action="{{route('admin.subscribers-send-mail')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea name="message"  class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary" style="submit">Send</button>
                 </form>
                </div>

              </div>
            </div>
          </div>

        </div>
      </section>
        <section class="section">

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Subscribers</h4>
                  </div>
                  <div class="card-body">
                    {{ $dataTable->table() }}
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
