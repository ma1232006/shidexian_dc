<?php


use Encore\Admin\Facades\Admin;

Encore\Admin\Form::forget(['map', 'editor']);

Admin::js('/vendor/chartjs/Chart.min.js');