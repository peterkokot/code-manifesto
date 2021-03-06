<?php

class SupporterController extends BaseController
{
    /**
     * Stores a new supporter to the database
     *
     * @return Response
     */
    public function newSupporter()
    {
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email'
        ];

        $validator = Validator::make( Input::all(), $rules );

        if ( $validator->fails() ) {
            return Redirect::to( '/support' )
                ->withErrors( $validator )
                ->withInput( Input::all() );
        } else {
            $supporter = new Supporter;
            $supporter->first_name = Input::get( 'first_name' );
            $supporter->last_name = Input::get( 'last_name' );
            $supporter->twitter_user = Input::get( 'twitter_user' );
            $supporter->github_user = Input::get( 'github_user' );
            $supporter->email = Input::get( 'email' );
            $supporter->city = Input::get( 'city' );
            $supporter->state = Input::get( 'state' );
            $supporter->country = Input::get( 'country' );
            $supporter->save();

            return Redirect::to( '/thankYou' );
        }
    }

    /**
     * Returns a view support
     *
     * @return Response
     */
    public function support()
    {
        return View::make( 'support' );
    }

    /**
     * Returns a view with all the supporters
     *
     * @return Response
     */
    public function thankYou()
    {
        return View::make( 'thank_you' )
            ->with( ['supporters' => Supporter::all()] );
    }
}
