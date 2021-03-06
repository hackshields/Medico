<link rel="stylesheet" href="{{ asset('sximo/js/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}">

@extends('layouts.app')
@section('content')

  <div class="page-content row">
    <!-- Page header -->

    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('clinicschedule?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'clinicschedule/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> ClinicSchedule</legend>
									
				  <div class="form-group hidethis " style="display:none;"> 
					<label for="ScheduleID" class=" control-label col-md-4 text-left"> 
					{!! SiteHelpers::activeLang('ScheduleID', (isset($fields['ScheduleID']['language'])? $fields['ScheduleID']['language'] : array())) !!}	
					</label>
					<div class="col-md-6">
					  {!! Form::text('ScheduleID', $row['ScheduleID'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
					 </div> 
					 <div class="col-md-2">
					 	
					 </div>
				  </div>
							@if(\Auth::user()->group_id==3)
								<input type="hidden" name="DoctorID" id="DoctorID" value="{{ \SiteHelpers::gridDisplayView(\Auth::user()->id,'UserID','1:tb_doctor:UserID:DoctorID') }}">
							@else
								<div class="form-group  " >
									<label for="Doctor" class=" control-label col-md-4 text-left">
										{!! SiteHelpers::activeLang('Doctor', (isset($fields['DoctorID']['language'])? $fields['DoctorID']['language'] : array())) !!}
									</label>
									<div class="col-md-6">
										<select name='DoctorID' rows='5' id='DoctorID' class='select2'   ></select>
									</div>
									<div class="col-md-2">

									</div>
								</div>
							@endif
				  <div class="form-group  " > 
					<label for="Clinic" class=" control-label col-md-4 text-left"> 
					{!! SiteHelpers::activeLang('Clinic', (isset($fields['ClinicID']['language'])? $fields['ClinicID']['language'] : array())) !!}	
					</label>
					<div class="col-md-6">
					  <select name='ClinicID' rows='5' id='ClinicID' class='select2 '   ></select> 
					 </div> 
					 <div class="col-md-2">
					 	
					 </div>
				  </div>

							<div class="form-group  " >
								<label for="VisitTime" class=" control-label col-md-4 text-left">
									{!! SiteHelpers::activeLang('Time Per Visit', (isset($fields['VisitTime']['language'])? $fields['VisitTime']['language'] : array())) !!}
								</label>
								<div class="col-md-6">
									<select name="VisitTime" class="select2" id="VisitTime">
										<option value="">-- Please Select --</option>
										<option {!! isset($row->VisitTime) && $row->VisitTime==15 ? 'Selected':'' !!} value="15">15 Minutes</option>
										<option {!! isset($row->VisitTime) && $row->VisitTime==20 ? 'Selected':'' !!} value="20">20 Minutes</option>
										<option {!! isset($row->VisitTime) && $row->VisitTime==30 ? 'Selected':'' !!} value="30">30 Minutes</option>
										<option {!! isset($row->VisitTime) && $row->VisitTime==45 ? 'Selected':'' !!} value="45">45 Minutes</option>
										<option {!! isset($row->VisitTime) && $row->VisitTime==60 ? 'Selected':'' !!} value="60">1 Hour</option>
									</select>
								</div>
								<div class="col-md-2">

								</div>
							</div>




						</fieldset>
			</div>
			
			

			

	@if($subgrid['access']['is_add'] == '1')				
	<hr /><div class="clr clear"></div>	
	
	<h5> Schedules </h5>
	
	<div class="table-responsive">
	    <table class="table table-striped ">
	        <thead>
				<tr>
					@foreach ($subgrid['tableGrid'] as $t)
						@if($t['view'] =='1' && $t['field'] !='ScheduleID')
							<th>
							{{ SiteHelpers::activeLang($t['label'],(isset($t['language'])? $t['language'] : array())) }}
							</th>
						@endif
					@endforeach
					<th></th>	
				  </tr>

	        </thead>

        <tbody>
        @if(count($subgrid['rowData'])>=1)
            @foreach ($subgrid['rowData'] as $rows)
	            <tr class="clone clonedInput">									
					 @foreach ($subgrid['tableGrid'] as $field)
						 @if($field['view'] =='1' && $field['field'] !='ScheduleID')
						 <td>					 
						 	{!! SiteHelpers::bulkForm($field['field'] , $subgrid['tableForm'] , $rows->$field['field']) !!}							 
						 </td>
						 @endif					 
					 
					 @endforeach
					 <td>
					 	<a onclick=" $(this).parents('.clonedInput').remove(); return false" href="#" class="remove btn btn-xs btn-danger">-</a>
					 	<input type="hidden" name="counter[]">
					 </td>
				</tr>  
			@endforeach
			

		@else

            <tr class="clone clonedInput">								
			 @foreach ($subgrid['tableGrid'] as $field)

				 @if($field['view'] =='1' && $field['field'] !='ScheduleID')
				 <td>					 
				 	{!! SiteHelpers::bulkForm($field['field'] , $subgrid['tableForm'] ) !!}
						</td>
				 @endif					 
			 
			 @endforeach
				 <td>
				 	<a onclick=" $(this).parents('.clonedInput').remove(); return false" href="#" class="remove btn btn-xs btn-danger">-</a>
				 	<input type="hidden" name="counter[]">
				 </td>
			
			</tr> 	
		@endif	


        </tbody>	

     	</table>  
    	<input type="hidden" name="enable-masterdetail" value="true">
    </div><br /><br />
     
     <a href="javascript:void(0);" class="addC btn btn-xs btn-info" rel=".clone"><i class="fa fa-plus"></i> New Item</a>
     <hr />		
	@endif
     
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('clinicschedule?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>


  <script type="text/javascript" src="{{ asset('sximo/js/plugins/bootstrap-timepicker/bootstrap-timepicker.js') }}"> </script>
  <script type="text/javascript">
	$(document).ready(function() {

//		$('.bootstrap-timepicker').timepicker({
//			showMeridian: false,
//			showInputs: true,
//			minuteStep: 5,
//			defaultTime : 0,
//
//		});
		$('.addC').relCopy({});
		
        $("#DoctorID").jCombo("{{ URL::to('clinicschedule/comboselect?filter=tb_users,tb_doctor:DoctorID:first_name|last_name&limit=Where:id:=:tb_doctor.UserID	') }}",
        {  selected_value : '{{ $row["DoctorID"] }}' });
        
        $("#ClinicID").jCombo("{{ URL::to('clinicschedule/comboselect?filter=tb_clinic:ClinicID:Name|Address&limit=Where:isDelete:=:0') }}",
        {  selected_value : '{{ $row["ClinicID"] }}' });
         

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		


	});
	</script>		 
@stop