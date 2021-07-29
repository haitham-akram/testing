<?php

namespace App\Console\Commands;

use App\Mail\NotifyMail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyE extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notify daily emails for users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $UsersEmail = User::select('email')->get();
      // $UsersEmail =User::pluck('email')->toArray();
        $data =['title'=>'programing','subject'=>'php'];
      foreach ($UsersEmail as $userEmail){
            Mail::to($userEmail)->send(new NotifyMail($data));
      }
    }
}
