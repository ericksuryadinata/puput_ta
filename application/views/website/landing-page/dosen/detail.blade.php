@extends('website.layout')

@section('title', 'Teknik Informatika Untag Surabaya')

@section('content')
<div class="main">
    <div class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{base_url()}}" target="_top">Home</a>
                <span class="fa fa-angle-double-right"></span>
                <span><a href="{{route('dosen.index')}}">Dosen</a></span>
                <span class="fa fa-angle-double-right"></span>
                <span class="current">Detail</span>
            </div>
        </div>
    </div>
    <section class="content-main">
        <div class="fullwidth-section">
            <div class="fullwidth-bg">	
                <div class="container">    
                    <div class="dt-sc-tabs-container type2">
                        <ul class="dt-sc-tabs">
                            <li class="current"><a class="current" href="#">Curriculum Vitae</a></li>
                            <li><a href="#" title="">Education Background</a></li>
                            <li><a href="#" title="">Teaching Experiences</a></li>
                            <li><a href="#" title="">Publications</a></li>
                        </ul>
                        <div class="dt-sc-tabs-content">
                            <div class="dt-sc-one-third column first">
                                <div class="hr-invisible-very-small"></div>
                                <div class="dt-sc-clear"></div>
                                <?php
                                    if(isset($dosen->nama_foto)){
                                        $foto = $dosen->nama_foto;
                                        if($foto !== ''){
                                            $placeholder = base_url().'uploads/images/dosen/'.$foto;
                                        }else{
                                            $placeholder = base_url().default_image_for('man');    
                                        }
                                    }else{
                                        $foto = '';
                                        $placeholder = base_url().default_image_for('man');
                                    }
                                ?>
                                <div class="dt-sc-team type2">
                                    <div class="dt-sc-team-thumb">
                                        <img src="{{$placeholder}}" style="object-fit:cover">
                                    </div>
                                    <div class="dt-sc-team-details">
                                        <h3>{{isset($dosen->nama) ? $dosen->nama : ''}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="dt-sc-two-third column">
                                <div class="dt-sc-hr-invisible"></div>
                                <div class="dt-sc-clear"></div> 
                                <h2><span>{{isset($dosen->nama) ? $dosen->nama : ''}}</span></h2>
                                <div class="hr-border-title"></div>
                                <div class="dt-sc-hr-invisible"></div>
                                <div class="alignleft">
                                    <h3>Position :</h3>
                                    <p>{{isset($dosen->posisi) ? $dosen->posisi : ''}}</p>
                                </div> 
                                <div class="dt-sc-clear"></div> 
                                <div class="alignleft">
                                    <h3>Contact Address :</h3>
                                    <p>{{isset($dosen->alamat) ? $dosen->alamat : ''}}</p>
                                </div> 
                                <div class="dt-sc-clear"></div> 
                                <div class="alignleft">
                                    <h3>Phone :</h3>
                                    <p>{{isset($dosen->telepon) ? $dosen->telepon : ''}}</p>
                                </div> 
                                <div class="dt-sc-clear"></div> 
                                <div class="alignleft">
                                    <h3>Fax :</h3>
                                    <p>{{isset($dosen->fax) ? $dosen->fax : ''}}</p>
                                </div>
                                <div class="dt-sc-clear"></div> 
                                <div class="alignleft">
                                    <h3>Email :</h3>
                                    <p>{{isset($dosen->email) ? $dosen->email : ''}}</p>
                                </div>
                                <div class="dt-sc-clear"></div> 
                                <div class="alignleft">
                                    <h3>Homepage :</h3>
                                    <p>{{isset($dosen->laman_web) ? $dosen->laman_web : ''}}</p>
                                </div>
                                <div class="dt-sc-clear"></div>
                                <div class="alignleft">
                                    <h3>Current Activity :</h3>
                                    <p>{!!isset($dosen->aktifitas) ? $dosen->aktifitas : ''!!}</p>
                                </div> 
                                <div class="dt-sc-clear"></div>
                                <div class="alignleft">
                                    <h3>Research Interest :</h3>
                                    <p>{!!isset($dosen->peminatan) ? $dosen->peminatan : ''!!}</p>
                                </div>
                                <div class="dt-sc-clear"></div> 
                                <div class="dt-sc-hr-invisible-very-small"></div>
                                <div class="dt-sc-clear"></div>
                            </div>
                        </div>
                        <div class="dt-sc-tabs-content">
                            <div class="dt-sc-six-sixth column first">
                                <div class="dt-sc-hr-invisible"></div>
                                <div class="dt-sc-clear"></div>
                                <h3>Education Background </h3>                                                       
                                <p></p>
                                <div class="dt-sc-hr-invisible-very-small"></div>
                                <div class="dt-sc-clear"></div>
                            </div>
                        </div>
                        <div class="dt-sc-tabs-content">
                            <div class="dt-sc-six-sixth column first">
                                <div class="dt-sc-hr-invisible"></div>
                                <div class="dt-sc-clear"></div>
                                <h3>Teaching Experiences </h3>
                                <p></p>
                                <div class="dt-sc-hr-invisible-very-small"></div>
                                <div class="dt-sc-clear"></div>
                            </div>
                        </div>
                        <div class="dt-sc-tabs-content">
                            <div class="dt-sc-six-sixth column first">
                                <div class="dt-sc-hr-invisible"></div>
                                <div class="dt-sc-clear"></div>
                                <h3>Publications </h3>
                                <p></p>
                                <div class="dt-sc-hr-invisible-very-small"></div>
                                <div class="dt-sc-clear"></div>
                            </div>
                        </div>
                    </div>
                <div class="dt-sc-hr-invisible"></div>   
                <div class="dt-sc-clear"></div>    
                @include('website.landing-page.includes.global-partner')
                <div class="dt-sc-hr-invisible-very-small"></div>
                <div class="dt-sc-clear"></div>
            </div>
        </div>
    </section>
</div>
@stop