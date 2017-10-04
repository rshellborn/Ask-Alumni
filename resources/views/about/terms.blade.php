@extends('layouts.maincontent')

@section('title')
    Terms of Service
@endsection

@section('content')
    <h3 class="text-center">Terms</h3>
    <p>By accessing the website at <a href="https://www.askalumni.ca">https://askalumni.ca</a>, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this website are protected by applicable copyright and trademark law.</p>

    <h3 class="text-center">General Rules</h3>
    <ul>
        <li>Harassment towards any user will not be tolerated and may result in a ban from the website.</li>
        <li>No profanity or offensive language is allowed on the forums or 'bio' in your profile under any circumstance.</li>
        <li>'Spamming' of points will not be tolerated and may result in your level and points to be set the original values of when you first registered on the website.</li>
        <small>'Spamming' includes creating forum posts or threads with no purpose other than to gain points, liking your own posts or threads, and anything else deemed as 'spam' by an Ask Alumni administrator.</small>
    </ul>


    <h3 class="text-center">Disclaimer</h3>
    <ol type="a">
        <li>The materials on RS Web Development's website are provided on an 'as is' basis. RS Web Development makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</li>
        <li>Further, RS Web Development does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.</li>
    </ol>


    <h3 class="text-center">Limitations</h3>
    <p>In no event shall RS Web Development or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on RS Web Development's website, even if RS Web Development or a RS Web Development authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>
    <h3 class="text-center">Accuracy of materials</h3>
    <p>The materials appearing on RS Web Development website could include technical, typographical, or photographic errors. RS Web Development does not warrant that any of the materials on its website are accurate, complete or current. RS Web Development may make changes to the materials contained on its website at any time without notice. However RS Web Development does not make any commitment to update the materials.</p>
    <h3 class="text-center">Links</h3>
    <p>RS Web Development has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by RS Web Development of the site. Use of any such linked website is at the user's own risk.</p>
    <h3 class="text-center">Modifications</h3>
    <p>RS Web Development may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</p>
    <h3 class="text-center">Governing Law</h3>
    <p>These terms and conditions are governed by and construed in accordance with the laws of Canada and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.</p>
    <div class="text-center">
        <br/>
        <p>If you have any questions about the Terms of Service, please <a href="{{url('/contact')}}">contact us.</a></p>
    </div>

    <div class="text-right">
        <small>Last updated on October 3, 2017</small>
    </div>
@endsection
