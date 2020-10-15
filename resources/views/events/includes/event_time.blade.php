@php
$start_date = Carbon::createFromFormat('Y-m-d H:i:s', $model_info->start_date . $model_info->start_time);
$end_date = Carbon::createFromFormat('Y-m-d H:i:s', $model_info->end_date . $model_info->end_time);

if ($model_info->start_date == $model_info->end_date) {

} else {
if (isset($model_info->start_time)) {
        echo $start_date->format('l jS \\of F h:i:s A');
    }
}

 if (isset($model_info->end_time)) {
        echo " – ".  $end_date->format('l jS \\of F h:i:s A');
 }
@endphp