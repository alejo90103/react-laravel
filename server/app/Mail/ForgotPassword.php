<?php
# @Author: Codeals
# @Date:   21-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 31-12-2019
# @Copyright: Codeals

namespace App\Mail;

use App\Token;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $token, $request, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Token $token, Request $request)
    {
        $this->user = $token->user;
        $this->token = $token;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = $this->request->input('url');

        return $this->from('info@codeals.es')
            ->view('mails.forgot-password')
            ->with('token', $this->token)
            ->with('url', $url)
            ->with('user', $this->user);
    }
}
