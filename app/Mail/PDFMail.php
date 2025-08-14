<?php 
namespace App\Mail;

use App\Models\GlobalModel;
use App\Models\QuestionModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PDFMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $id;
    protected $aggname;
    protected $pdfname;
    /**
     * Create a new message instance.
     */
    public function __construct($id ,$aggrement =false)
    {
        $this->aggname = $aggrement  ? 'Risk Assesment' : 'Service Aggrement';
        $this->pdfname = $aggrement  ? 'Risk-Assesment' : 'Service-Aggrement';
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->aggname . ' : Grow Fortuna',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // now fetcheding the data from the db 
          // Fetch the risk model
          $data =  $this->id;
          $risk['riskmodel'] = $this->getcommandata($data)['riskmodel'];

          // Fetch questions with subquestions and options
          $risk['questions'] = $this->getcommandata($data)['questions'];
  
  
          // Fetch serviceaggrment
          $risk['serviceagreement'] = $this->getcommandata($data)['serviceagreement'];
  
          // Fetch user responses joined with options
           $risk['answers'] =$this->getcommandata($data)['answers'];


 if($this->pdfname == 'Service-Aggrement'){
            $pdf = Pdf::loadView('emails.aggrement', compact('risk'));

           }else{
            $pdf = Pdf::loadView('admin.service.pdf', compact('risk'));

           }
        return $this->view('emails.pdf' , compact('risk'))
            ->subject('PDF Attachment')
            ->attachData($pdf->output(), $this->pdfname.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    static public function getcommandata($id)
    {
        // Fetch the risk model
        $risk['riskmodel'] = GlobalModel::getSingleData('risk', 'id', $id);
        $risk['serviceagreement'] = GlobalModel::getSingleData('serviceagreement', 'risk_id', $id);
        $risk['questions'] = QuestionModel::with(['subquestions.options', 'options'])->get();
        $risk['answers'] =  DB::table('userresponse')
            ->join('options', 'options.id', '=', 'userresponse.option_id')
            ->where('userresponse.risk_id', $id)
            ->get();
        return $risk;
    }
}

?>