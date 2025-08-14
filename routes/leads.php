<?php

use App\Http\Controllers\admin\leads\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;


Route::prefix('admin/leads')->middleware([AuthenticateMiddleware::class])->group(function(){
    Route::get('/',[LeadController::class,'index'])->name('leads.all');
    Route::get('/invoice/{lead}',[LeadController::class,'invoice'])->name('leads.invoice');
    Route::get('/pool-leads',[LeadController::class,'poolindex'])->name('leads.pool');
    Route::get('/stat`us/{status}',[LeadController::class,'status']);
    Route::get('/create',[LeadController::class,'create'])->name('leads.create');
    Route::post('/store',[LeadController::class,'store'])->name('leads.store');
    Route::get('/edit/{id}',[LeadController::class,'edit']);
    Route::post('/update',[LeadController::class,'update'])->name('leads.update');
    Route::post('/delete/{id}',[LeadController::class,'delete']);
    Route::post('/import', [LeadController::class, 'import'])->name('leads.import');
    Route::get('/assign', [LeadController::class, 'assign'])->name('leads.assign');
    Route::post('/export', [LeadController::class, 'exportLeads'])->name('leads.export');
    Route::get('/updatepayment/{lead}', [LeadController::class, 'updatepayment'])->name('leads.updatepayment');

    Route::get('/lead-status/{slug}', [LeadController::class, 'leadstatus'])->name('leads.status');
    Route::get(uri :'/updatestatus/{id}',action : [LeadController::class,'getCurrentStatus']);
    Route::post(uri :'/updatestatus',action : [LeadController::class,'UpdateCurrentStatus']);
    Route::post(uri :'/updatepayment',action : [LeadController::class,'updatepaymentstatus'])->name('leads.remaining-payment.update');
    Route::post(uri :'/holdpaymentstatusUpdate',action : [LeadController::class,'holdpaymentstatusUpdate'])->name('leads.hold-payment.update');
    Route::get(uri :'/holdamountstatus/{lead}',action : [LeadController::class,'holdamountstatus'])->name('leads.holdamountstatus');
    Route::post('/assignleadcount', [LeadController::class, 'assignleadcount']);
    Route::get('/assigned', [LeadController::class, 'assigned'])->name('leads.assigned');
    Route::get('/today-leads', [LeadController::class, 'assignedtoday'])->name('leads.assigned.today');
    Route::post('/assignstore', [LeadController::class, 'assignstore'])->name('leads.assignstore');
    Route::post('/filterdata', [LeadController::class, 'filter'])->name('filter.leads');
    Route::get('/payment', action: [LeadController::class, 'payment'])->name('lead.payments');
    Route::get('/donwloadsampleexcel', [LeadController::class, 'donwloadsampleexcel'])->name('leads.sample-excel');
    Route::post('/make-call', [LeadController::class, 'makeCall'])->name('make-call');
    Route::get('/extract', [LeadController::class, 'extract'])->name('leads.extract');
    Route::post('/extract-leads', [LeadController::class, 'extractFilter'])->name('extract.leads');
    Route::post('/project-phase',[LeadController::class,'phase'])->name('leads.phase.quoatation');
    Route::post('/exist-project',[LeadController::class,'existproject']);
    Route::get('/commission',[LeadController::class,'commission'])->name('leads.commission');
    Route::get('/withdraw',[LeadController::class,'withdraw'])->name('leads.withdraw');
    Route::post('/withdrawrequest',[LeadController::class,'withdrawrequest'])->name('leads.withdrawrequest');

});





?>