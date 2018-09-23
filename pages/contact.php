<div class="container">

    <div class="row">

        <div class="col-xl-8 offset-xl-2 py-5">

            <h1>Contact</h1>
            <p>Voor vragen of boekingen kunt u mij hier contacteren</p>

            <!-- We're going to place the form here in the next step -->
            <form id="contact-form" method="post" action="/index.php" role="form">

                <div class="messages"></div>

                <div class="controls">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kl">Voornaam *</label>
                                <input id="form_name" type="text" name="name" class="form-control"
                                       placeholder="Geef uw voornaam op *" required="required"
                                       data-error="Voornaam vereist.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_lastname">Achternaam *</label>
                                <input id="form_lastname" type="text" name="surname" class="form-control"
                                       placeholder="Geef uw achternaam op *" required="required"
                                       data-error="Achternaam vereist.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_email">Email *</label>
                                <input id="form_email" type="email" name="email" class="form-control"
                                       placeholder="geef uw email op *" required="required"
                                       data-error="Geldig email aub.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_need">Wat wenst u informatie of boeken *</label>
                                <select id="form_need" name="need" class="form-control" required="required"
                                        data-error="Geef uw keuze op aub.">
                                    <option value=""></option>
                                    <option value="Aanvraag informatie">Informatie</option>
                                    <option value="Aanvraag boeking">Timothy boeken</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form_message">Vraag/Bericht *</label>
                                <textarea id="form_message" name="message" class="form-control"
                                          placeholder="Plaats hier uw vraag of bericht *" rows="4" required="required"
                                          data-error="Laat een vraag of bericht achter aub ."></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                          
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name='submit' class="btn btn-success btn-send" value="Send message">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-muted">
                                <strong>*</strong> These fields are required.
                            </p>
                        </div>

                    </div>
                </div>

            </form>

        </div>

    </div>

</div>


</main>
