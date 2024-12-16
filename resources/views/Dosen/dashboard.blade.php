@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Total Tugas Card -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalTugasUser }}</h3>
                        <p>Total Tugas Saya</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <a href="/Pendidik" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
                </table>
            </div>
        </div>
    </div>
@endsection
