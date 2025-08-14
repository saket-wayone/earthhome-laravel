<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Investment Advisor Agreement</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin/images/logo.webp') }}" />

    <style>
      .defaulthide {
    display: none;
    /*border-top:2px solid black;*/
}

.content {
    position: relative;
    z-index: 1;
}

body::before {
    content: "";
    position: fixed;
    top: 50%;
    left: 50%;
    width: 50%; /* Adjust the width of the watermark image */
    height: 50%; /* Adjust the height of the watermark image */
    transform: translate(-50%, -50%); /* Center the image */
    background: url(https://crm.growfortuna.com/admin/images/growinvestment.png) no-repeat center center;
    background-size: contain; /* Adjust the size of the background image */
    opacity: 0.1;
    z-index: -1;
}

@media print {
    .no-print {
        display: none !important;
    }

    .defaulthide {
        border-top: 2px solid black;
        display: block;
    }

    .image {
        margin-top: 5px;
    }

    .content {
        margin-bottom: 30mm; /* Space for the footer */
        page-break-after: always;
    }

    .content:last-child {
        page-break-after: auto; /* Avoid a blank page at the end */
    }

    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 20mm;
        text-align: center;
        font-size: 12px;
    }
}

.content {
    margin-bottom: 30mm !important; /* Space for the footer */
}

.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 20mm;
    text-align: center;
    font-size: 12px;
}
    </style>
</head>

<div class="header" style=" text-align: right;font-size:13px;
">
    Stamp Reference# {{$risk['riskmodel']->certificateid ?? ''}}
</div>


<body style="font-family: sans-serif; margin: 40px;font-size:18px !important;">
    @if(!empty($risk['riskmodel']->scannedimage))
    <div class="image" style="
    height: 95vh;
">
        <img src="{{asset($risk['riskmodel']->scannedimage)}}" style="width:100%;max-height:95vh;object-fit:contain;">

    </div>
    @endif()
    <div class="content">
        <div style="text-align: left;">
            <img src="https://crm.growfortuna.com/admin/images/growinvestment.png" alt="Logo" style="width: 100px;">
            <h1 style="font-size: 24px;text-decoration: underline;text-align: center;margin-top: -34px;">Investment Advisor
                Agreement</h1>
        </div>
        <br style="margin-top: 20px;">
        <p style="text-align: justify;">This Investment Advisor Agreement is made on @if(!empty($risk['serviceagreement']->joining_date)) {{date('d-m-Y', strtotime($risk['serviceagreement']->joining_date))}} @endif()
            <!--<span style="font-style: italic;color: black; font-weight: bold;"> </span> -->


            between Dhruvin Bhanushali
            who is a SEBI registered Investment Adviser having registration number INA000019017 and holding its
            registered office at Mulund, Mumbai, here in after called the Advisor or IA.
        </p>
        <p style="text-align: justify;">AND</p>
        <p style="text-align: justify;">
            <!--<span style="color: black; font-weight: bold; text-decoration: underline">-->

            @if($risk['riskmodel']->gender =='Male')
            Mr.

            @else
            Mrs.
            @endif()



            {{$risk['riskmodel']->name ?? ''}},
            <!--</span>-->
            having his residence
            at
            <!--<span style="color: black; font-weight: bold; text-decoration: underline">-->


            {{$risk['riskmodel']->address ?? ''}}, India<!--</span>-->, here in after
            called the Client. The Client Gives his consent in regard to this investment agreement that “I/We have read
            and understood the terms and conditions of Investment Advisory services provided by the Investment Adviser
            along with the fee structure and mechanism for charging and payment of fee. Based on our written request to
            the Investment Adviser, an opportunity was provided by the Investment Adviser to ask questions and interact
            with “person(s) associated with the investment advice”.
        </p>
        <p style="text-align: justify;"><b>Declaration by the Investment Adviser:</b> The Investment Advisor shall render and
            charge fee for Investment
            advice as per the regulation stated in regard to signing of this agreement by the client.</p>
        <p style="text-align: justify;">Investment Adviser shall not manage funds and securities on behalf of the client and
            shall only receive such
            sums of monies from the client as are necessary to discharge the client’s liability towards fees owed to the
            Investment Adviser.</p>

        <p style="text-align: justify;">
            Investment Adviser, shall not during the course of performing its services to the client, hold out any
            investment advice implying any assured returns or minimum returns or target return or percentage accuracy or
            service provision till achievement of target returns or any other nomenclature that gives the impression to
            the
            client that the investment advice is risk-free and/or not susceptible to market risks and or that it can
            generate
            returns with any level of assurance. The Investment Advisor acts in fiduciary capacity towards the Client
            and
            provides services subscribed in a professional and diligent manner. </br> </br>
            WHEREAS Advisor has been authorized by SEBI to provide investment advice in terms of SEBI (Investment
            Advisers) Regulations, 2013.</br> </br>
            AND WHEREAS client wishes to invest in the securities market in accordance with the advice of the
            Advisor.
       <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
        </br></br>
        NOW, THEREFORE, in consideration of the mutual covenants contained in this agreement, the parties hereby
        agree as follows
        </p>

        <p style="text-align: justify;">
            <b> 1. Appointment of Advisor: </b>The Client hereby appoints the Advisor as investment adviser with power
            and
            authority to provide advice relating to investing in, purchasing, selling or otherwise dealing in securities
            or
            investment products, and advice on investment portfolio containing securities or investment products,
            whether
            written, oral or through any other means of communication for the benefit of the client and shall include
            financial planning
        </p>


        <p style="text-align: justify;">
            <b>2. Fees specified under Investment Adviser Regulations and relevant circulars issued thereunder:</b>
            Regulation 15 A of the amended IA Regulations provide that Investment Advisers shall be entitled to charge
            fees from a client in the manner as specified by SEBI, accordingly Investment Advisers shall charge fees
            from
            the clients in either of the two modes:

        </p>
        <p style="text-align: justify;">
            <b> (A) Assets under Advice (AUA) mode </b>
        </p>
        <p style="text-align: justify;"> a. The maximum fees that may be charged under this mode shall not exceed 2.5percent
            of AUA per
            annum per client across all services offered by IA. </p>
        <p style="text-align: justify;"> b. IA shall be required to demonstrate AUA with supporting documents like
            dematstatements, unit
            statements etc. of the client.</p>
        <p style="text-align: justify;"> c. Any portion of AUA held by the client under any pre-existing
            distributionarrangement with any entity
            shall be deducted from AUA for the purpose of charging fee by the Investment adviser.</p> </br></br>

        <p sttylestyle="text-align: justify;"> <b>(B) Fixed fee mode the maximum fees that may be charged under this mode
                shall not exceed INR 1,25,000
                per annum per client across all services offered by Investment adviser.
                General conditions under both modes:</b></p>
        <p style="text-align: justify;"> a. In case “family of client” is reckoned as a single client, the fee as referred
            aboveshall be charged per
            “family of client”. </p>
        <p style="text-align: justify;"> b. IA shall charge fees from a client under any one mode i.e. (A) or (B) on an
            annualbasis. The change of
            mode shall be affected only after 12 months of on boarding/last change of mode.</p>
        <p style="text-align: justify;"> c. If agreed by the client, IA may charge fees in advance. However, such
            advanceshall not exceed fees
            for 2 quarters.</p>
     
        <p style="text-align: justify;"> d. In the event of pre-mature termination of the Investment adviser services in
            terms ofagreement, the
            client shall be refunded the fees for unexpired period.However, Investment adviser may retain a
            maximum breakage fee of not greater than one quarter fee.
        </p>
        
          <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
</br>
</br>
        <br>
        <b>3. Fees charged to the client:</b> The total subscription fee for the <b>{{$risk['serviceagreement']->package}}
        </b> is Rs. {{$risk['serviceagreement']->packageamount}}/- including GST for the tenure of
        @if($risk['serviceagreement']->months !='')
        {{$risk['serviceagreement']->months}} months
        @else
        {{$risk['serviceagreement']->days}} days
        @endif
        (After
        applying discount of {{$risk['serviceagreement']->discountpercentage}}%), the discounted subscription plan is Rs {{$risk['serviceagreement']->discountamount}}/- out of which client has paid Rs.
        {{$risk['serviceagreement']->paidamount ?? 0}}/- In case client fails to pay the remaining amount due to any reason (personal or financial reason), then
        the service will be provided for the amount received. </br></br>
        In case the client wishes to add/buy any additional subscription under the same risk category and respective
        product suitability as per their Product suitability table during their tenure by paying additional charges to
        the
        IA then In this event only an acknowledgement will be sent to their registered email id by the IA side. The
        Terms and conditions will remain applicable same as of the base agreement signed at the first instance
        between the IA & the Client. However, if the client select product which falls under different category of risk
        and the product suitability as per the product suitability table then in that case the client needs to execute a
        fresh agreement between the Client & the IA.
        </p>
        <br>
        <b> 4. Scope of Services: </b>The Investment Advisor provides three forms of services as given below-: </br></br>
        a. <span style="text-decoration: underline;">Normal Services- </span>This is a basic service in which
        recommendations will be provided through
        SMS/Mobile Application channel only. However, telephonic support will be provided to the client. IA
        will provide service contact number to client in which client can call anytime during office hours to
        avail the services apart from SMS and ask for any other type of assistance as per his/her wish. </br> </br>
        b. <span style="text-decoration: underline;"> Premium Services-</span> This is a privileged service in which
        recommendation will be provided through
        both SMS/Mobile Application and Calls channel. Dedicated equity advisor will be provided to the
        client for entry and exit, quantity during trade, market updates, educating on how to operate DEMAT
        account, technical and fundamental analysis on weekends with prior appointment.</br> </br>
        c.<span style="text-decoration: underline;"> Premium Plus Services- </span>This is an extra premium service
        available only for HNI’s and businessman.
        Dedicated analyst, senior manager and equity advisor will be appointed to this category from 9.00AM
        to 11.30PM which covers equity, commodity and currencies market, recommendation will be provide
        through both SMS and Call or any other client selected medium, portfolio rebalancing, upcoming
        events, IPO analysis and quarterly result analysis benefits comes under this category.
       
        <p>
            Every recommendation consists of entry, target and stop loss levels. Any change in trend of the stock will be
            informed to the client. Prices of services may vary depend upon the service opted by client.

        </p>
         </br> </br>
        </p>
       <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>


        <b> 5. Functions of the Investment Adviser: </b>Functions, obligations, duties, and responsibilities of the
        Investment Adviser, with specific provisions covering, inter alia, </br></br>
        a) Terms of compliance with the Securities and Exchange Board of India (Investment Advisers)
        Regulations, 2013 and its amendment, rules, circulars and notifications: Client has hired Advisor to
        act as his or her investment advisor to perform the services described in this Agreement. Specifically,
        client grants advisor full power to direct the investment and reinvestment of the assets in the account,
        the proceeds, and any additions. Advisor’s authority over client’s investments includes discretionary
        authority to advice the client regarding purchase, sell or hold securities for client’s account in
        accordance with client’s objectives as client has communicated those to the advisor. Advisor will have
        no authority to execute any trade or withdraw or transfer assets from client’s account.
        b) Compliance with the eligibility criteria as specified under the Investment Adviser Regulations at all
        times.</br></br>
        c) Risk assessment procedure of client including their risk capacity and risk aversion.</br></br>
        d) Providing reports to clients on potential and current investments - Advisor will generally be available
        to discuss client’s account during normal business hours and will contact client periodically. Advisor
        will also review Client’s account performance and the continued product suitability of investments
        recommended by the advisor for the client on half yearly basis after discussion with the client. No
        services other than those discussed in this Agreement, are implied or guaranteed, except as
        individually negotiated and confirmed in writing. Advisor is responsible only for their advice on
        assets (financial assets) over which client has provided Advisor discretionary authority and not for the
        diversification or prudent investment of any other assets of Client.</br></br>
        e) Maintenance of records i.e. client-wise KYC, risk assessment, analysis reports of investment advice
        and Product suitability, terms and conditions document, related books of accounts and a register
        containing list of clients along with dated investment advice and its rationale in compliance with the
        Securities and Exchange Board of India (Investment Advisers) Regulations, 2013.</br></br>
        f) Provisions regarding audit as per the Securities and Exchange Board of India (Investment Advisers)
        Regulations, 2013. </br> </br>



        g) Undertaking to abide by the Code of Conduct as specified in the Third Schedule of the Securities and
        Exchange Board of India (Investment Advisers) Regulations, 2013.</br> </br>

        <b>6. Investment objective and guidelines:</b></br> </br>
        a) Investment advice would be provided for equity, derivative and other financial instruments. I
        undertake to recommend direct implementation of advice i.e.


      


        though direct schemes/direct codes, and
        other client specifications / restrictions on investments if any.


        b) Financial plan would be based on the risk profiling conducted for the client, time period for
        deployment of funds and other relevant factors. </br> </br>

 <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>


        </br> </br>


        c) Tax related aspects pertaining to investment
        advice.
        Please Note- As per the SEBI PR No.:30/2021 on 21st OCTOBER 2021 , We never provide any
        Advice in regards to Digital gold, Non-fungible tokens(NFT),Cryptocurrencies or any other
        unregulated market product nor we encourage anyone to trade in such unregulated products, If anyone
        found trying to provide the same in the name of Grow Fortuna or Mr. Dhruvin Bhanushali, do report
        to us the same over compliance@growfortuna.com .</br> </br></br> </br>
        <p>



            <b> 7. Definitions: </b>In this Agreement (including the above Recitals) and in the Annexures hereto, unless the
            context otherwise requires, the following expressions shall have the respective meanings set out against
            them:</br></br>
            a) <b> Act</b> means SEBI Act, 1992.</br></br>
            b) <b> Advisor</b> means Dhruvin Bhanushali.</br></br>
            c) <b> Capital </b>means an amount maintained by client in his Demat Account.</br></br>
            d) <b> Derivatives </b>means as defined under section 2 of the Securities Contract Regulation Act, 1956 and
            include
            inter alia,</br></br>
            i. A security derived from a debt instrument, share, loan whether secured or unsecured, risk
            instrument or contract for differences or any other form of security; ii. A contract which derives
            its value from the prices, or index or prices, of underlying securities.</br></br>
            e) <b> Effective</b> Date means the date of execution of this Agreement.</br></br>
            f) <b> Financial</b> Risk is a type of danger that can result in the loss of capital.</br></br>
            g) <b> Futures</b> are derivative financial contracts that obligate the parties to transact an asset at a
            predetermined
            future date and price.</br></br>
            h) <b> Options</b> The contractual right, but not obligation, to buy (call option) or sell (put option) a
            specified
            amount of underlying security at a fixed price (strike price) before or at a designated future date
            (expiration date). The option writer is the party that sells the option. As per the Securities Contract

       
            Regulation Act (SCRA)1956 , “option in securities” means a contract for the purchase or sale of a right to


            buy or sell, or a right to buy and sell, securities in

        future, and includes a Teji, a mandi, a Teji mandi, a
        galli, a put, a call or a put and call in securities.

      
        i) <b> Price</b> Target is the projected future price level of an asset as stated by an investment adviser. The
        price
        target is based on assumptions about the assets future supply and demand, technical levels, and
        fundamentals.
        
        
        
        j) <b> Quarter</b> means a period of 3 successive calendar months ending on the last date of the month of March
        or
        June or September or December of the respective calendar year.</br></br>
        
          </br></br>
        <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
          </br></br>




        k) <b> Family</b> of Client shall include individual Client, dependent spouse, dependent children and dependent
        parents as confirmed by the Client, at the time of entering into the agreement or at any subsequent
        amendments thereof; The dependent family members shall be those members whose assets on which
        investment advisory is sought/provided, originate from income of a single entity i.e. earning individual
        Client in the family.
        
        
        
        </br></br>
        l) <b> Regulations</b> mean SEBI (Investment Advisers) Regulations, 2013</br></br>




        m)<b> SEBI </b> means Securities and Exchange Board of India.</br></br>
        n)<b> Securities </b>means Securities as defined under Section 2 of Securities Contracts and Regulation Act,
        1956.</br></br>
        o)<b> Services</b> mean the investment advisory services provided by the Advisor.</br></br>
        p)<b> Stock</b> is a general term used to describe the ownership certificates of any company.</br></br>
        q)<b> Stop loss</b> means an advance order to sell an asset when it reaches a particular price point. It is used
        to
        limit loss or gain in a trade.</br></br>
        r)<b>Trailing stop</b> loss is a type of stop-loss order that combines elements of both risk management and
        trade
        management. Trailing stops are also known as profit protecting stops because they help lock in profit on a
        trade while also capping the amount that will be lost if the trade does not work out.</br></br>
        s)<b> Officially Valid </b> Documents shall means</br></br> a) the passport,</br> b) the driving license,</br>
        c) proof of
        possession of
        Aadhaar number,</br> d) the Voter's Identity Card issued by Election Commission of India, e) job card issued
        by NREGA duly signed by an officer of the State Government and </br>
        f) the letter issued by the National
        Population Register containing details of name, address, or any other document as notified by the Central
        Government in consultation with the Regulator; as his service days only.
        
        
        
      
        t) <b> Electronic signature</b> shall mean authentication of any electronic record by a subscriber by means of
        the
        electronic technique specified

        in the Second Schedule and provisions of section 3A of Information
        Technology Act and includes digital signature.</br></br>
        u) <b> Digital signature </b> shall mean authentication of any electronic record by a subscriber by means of an
        electronic method or procedure in accordance with the provisions of section 3 of Information Technology
        act.</br></br>
        
        
        
        
        
        
        </br></br>
        
        
        
        
         <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>

</br></br>
        
        
        v)<b> Affixing electronic</b> signature shall mean with its grammatical variations and cognate expressions means
        adoption of and methodology or procedure by a person for the purpose of authenticating an electronic
        record by means of digital signature.</br></br>
        w)<b> Website </b> shall mean www.growfortuna.com and such other internet sites maintained/launched/designated
        by the Advisor.</br></br>
        x)<b> Mobile Application</b> a mobile application, most commonly referred to as an app, is a type of application
        software designed to run on a mobile device, such as a Smartphone or tablet computer.
        Investment advice given through newspaper, magazines, any electronic or broadcasting or telecommunications
        medium, which is widely available to the public, shall not be considered as investment advice for the purpose
        of these regulations.</br></br>
        </p>

        <p>
            <b>8. Risk Factor:</b> As per the risk profiling done by the Investment advisor, the client’s risk score is <b> {{$risk['riskmodel']->totalpoints ?? ''}} </b>
            and
            the
            Product Suitability Category is <b> {{$risk['riskmodel']->riskfactor ?? ''}}</b>. A detailed statement of risks associated with each type of
            investment covering the standard risks associated with each type of investment in securities and the
            product suitability statement has been sent to the client’s registered email address and also mentioned here
            below. If at any moment during the service period the client want to change his/her Risk profile score, the
            client can do so by filling the RPM change form/or giving consent over email with the investment advisor.
        </p>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        
       
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
       <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>


        <p><strong>9. Product Suitability Table:</strong></p>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th style="border: 1px solid black; padding: 8px;">Risk Category</th>
                <th style="border: 1px solid black; padding: 8px;">Risk Score</th>
                <th style="border: 1px solid black; padding: 8px;">Product Suitability</th>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 8px;">Very High Risk</td>
                <td style="border: 1px solid black; padding: 8px;">15.5-20</td>
                <td style="border: 1px solid black; padding: 8px;">
                    Option writing, Positional Future, Leverage Trading, FX,<br>
                    Category include High, moderate and low risk
                </td>
            </tr>

            <tr>
                <td style="border: 1px solid black; padding: 8px;">High Risk</td>
                <td style="border: 1px solid black; padding: 8px;">10.5-15</td>
                <td style="border: 1px solid black; padding: 8px;">
                    Intraday cash & future.<br>
                    Delivery Trading, Naked Option (Buy Side), MCX Trading, Category include moderate & low risk
                </td>
            </tr>

            <tr>
                <td style="border: 1px solid black; padding: 8px;">Moderate Risk</td>
                <td style="border: 1px solid black; padding: 8px;">5.0-10.0</td>
                <td style="border: 1px solid black; padding: 8px;">
                    Intraday Cash (No leverage), Delivery Trading & option strategies, category include low risk
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 8px;">Low Risk</td>
                <td style="border: 1px solid black; padding: 8px;">0.5-4.5</td>
                <td style="border: 1px solid black; padding: 8px;">
                    Delivery trading (least quantity), Bank FD, Post office scheme, Government bonds, Bonds with credit
                    rating more than AA.
                </td>
            </tr>
        </table>
        <p style="margin-top: 20px;"><strong>10. Amendments:</strong> The agreement will <strong>not</strong> be amended
            till both parties have given their mutual consent through either written notice or via an email from registered
            email ids.</p>


        <strong>11. Termination: </strong>Know your customer (KYC), risk profiling, service agreement and welcome call is
        the part
        of compliance and cost of compliance is already included in the subscription Fee. Only, after completion
        of compliance, the service shall start according to the subscription plan. </br></br>
        <strong> a. Voluntary/Mandatory termination of agreement from client side-</strong> In case of a voluntary
        termination of the agreement, the client would be required to give a 30- day prior written notice and
        should write the reason of termination of an agreement. Client gives one month notice to Investment
        advisor, for such notice period, a notice pay from the fee shall be deducted.</br></br>
        <strong> b. Voluntary/Mandatory termination of agreement from IA side - </strong> In case, if client earns profit of
        4 times amount of the subscription fee paid (excluding taxes) then the Investment Advisor may
        terminate the agreement after sending written mail/notice to client registered mail id/address. We
        would like to inform you that, any non-paid recommendation provided by Investment Advisor is a
        part of services and after joining the paid services ,the profit or loss earned in any non-paid
        recommendation will be counted while calculating the performance of the portfolio, the profit or loss
        earned in any non-paid recommendation will be added in the overall performance.</br></br>
        <strong> c. Suspension / Cancellation of registration of Investment Adviser by SEBI -</strong> In case of
        suspension or cancellation of the certificate of registration of the Investment Adviser, this agreement
        will be handled as per the decree passed by the competent regulatory authority/body.
     
        </br></br>
        
        
          <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>

 </br></br>
        
        d. Any other action taken by other regulatory body/government authority.

        The Investment advisor reserves the right to restrict, suspend or discontinue the client’s access to its advisory
        services in the context of the abusive nature of (any type) of the client towards the IA or its employees. If the
        client’s services have been disabled, suspended, or discontinued by the IA, the client agrees to not create a
        new account/service, whether with the client’s information or otherwise. The IA reserves the right to show
        cause to the client for his misconduct on the part of the services provided by the IA and proceed
        accordingly.</br></br>


        <p><strong>12. Implications of Amendments and termination </strong> is explained hereunder </p>
        <p>
            <strong> a) Partial Refund Policy- </strong>Non-discounted subscription plans are partially refundable and
            refund
            amount will be sole discretion and decided by management after studying the case. Minimum
            service fee of one quarter plus the compliance cost and a notice pay of one month shall have to borne
            by the client. In the event of unfortunate demise of the client, Advisor will refund the balance tenure
            subscription amount to the family of the client after receiving of respective documents. The Client
            expressly agrees and undertakes that in event of refund of the subscription fee (fully or partially) paid
            to the Investment advisor by the client, the client will be signing a refund/settlement letter with the IA
            stating the amount of refund and other details including withdrawal of any complaints made by the
            client (if any) after the refund amount is settled by the IA into the clients account. The client agrees to
            sign & share the same as and when required by the Investment Advisor for early and speedy disposal
            of the case.</br></br>
            <strong> b) No Refund Policy- </strong>Discounted Subscription plans and plan with duration of 1 day to 3 months
            are non-refundable. The Advisor is an investment advisor which never claims 100% guarantee in the
            securities and commodity market. As per the past performances, the Investment Advisor maintains
            70-80% call accuracy consistently. Our research team is highly qualified and does all their analytics
            based on technical and fundamental analysis with due diligence. The investment Advisor believe that
            client is aware of both profit and loss side of the market.</br></br>
            <strong> 13. Relationship with related parties: </strong>Investment Advisor is carrying on its activity
            independently and has
            no relation with anyone such as brokers, sub-brokers, mutual fund companies or any kind of distribution
            services. Investment advisor charges only their advisory fee which is clearly specified in the agreement
            and website.</br></br>
            <strong> 14. Representation to client: </strong> Investment adviser ensures that he will take all consents and
            permissions from
            the client prior to undertaking any actions in relation to the securities or investment product advised by the
            IA. Dhruvin Bhanushali serves all its customers only vide the phone no. series as mentioned in the
            Website & Annexure.
            
           



 
         
            
            </br></br>
            <strong> 15. No Right to Seek Power of Attorney: </strong> The Investment Adviser shall not seek any power of
            attorney or
            authorizations from its clients for implementation of investment advice.

       

        </br>
        </br>
        
           <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>

  </br>
        </br>


        <strong> 16. No conflict of interest:</strong> The Investment Adviser to clearly declare that it will disclose
        all conflicts of
        interest as and when they arise and not derive any direct or indirect benefit out of the client’s
        securities/investment products.</br></br>
        
        
        
        <strong> 17. Maintenance of accounts and confidentiality: </strong>The investment adviser shall be responsible
        for the
        maintenance of client accounts and data as mandated under the SEBI (IA) Regulations,2013. The
        Investment advisor has all the rights to ask for relevant documents of trade in the market executed by the
        client like a ledger and profit & loss statements etc. at any moment of time within or after the expiry of
        services and the client agrees to share the same as and when required by the Investment Advisor.
        Additionally, the clients who request a refund of the paid service subscription fee agree to share all (or
        any) of the documents requested by the Investment Advisor.</br></br>

        </p>

        <p>
            18. Terms of fees and billing:</br>
            Fee realization – Example</br>
            a) Fixed fee of Rs. 60,000 for a particular service for 6 months?</br>
            b) Fee for one day – Rs. 330</br>
            c) Post confirmation of payment of fee, receipt for the same will be e-mailed to the client’s email
            address.</br>
            d) Billing will be done once in 6 months. The payment of fees shall be through direct credit to the bank
            account through NEFT/RTGS/IMPS/UPI or any other mode specified by SEBI from time to time.
            However, the fees shall not be accepted in cash.
            The fees shall be payable while confirming the engagement via account transfer or UPI. Bank details
            mentioned below:
        </p>

        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
      
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
       <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
        </br>

        </br>
        </br>
        </br>
        </br>

        </br>
        <h2 style="text-align: left;">Bank Details</h2>

        <table style="width: 100%; background-color: lightblue;  box-sizing: border-box;">
            <tr>
                <th colspan="1" style="padding: 10px;"></th>
                <th colspan="1" style="padding: 10px;text-align:justify;">Dhruvin Bhanushali</th>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>Account Number:</strong></td>
                <td style="padding: 10px;">50200095284540</td>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>IFSC Code:</strong></td>
                <td style="padding: 10px;">HDFC0000540</td>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>Bank Name:</strong></td>
                <td style="padding: 10px;">HDFC Bank Ltd</td>
            </tr>
        </table>



        <table style="width: 100%; background-color: lightblue; margin-top:40px;  box-sizing: border-box;">
            <tr>
                <th colspan="1" style="padding: 10px;"></th>
                <th colspan="1" style="padding: 10px;text-align:justify;">Grow Fortuna</th>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>Proprietor:</strong></td>
                <td style="padding: 10px;">Dhruvin Bhanushali</td>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>Account Number:</strong></td>
                <td style="padding: 10px;">50200095284540</td>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>IFSC Code:</strong></td>
                <td style="padding: 10px;">HDFC0000540</td>
            </tr>
            <tr>
                <td style="padding: 10px;"><strong>Bank Name:</strong></td>
                <td style="padding: 10px;">HDFC Bank Ltd</td>
            </tr>
        </table>


        <h2 style="margin-top: 40px;">19. Liability of investment adviser:</h2>

        <p>Except as otherwise provided by law, the Advisor or its officers, directors, employees or affiliates will not be
            liable to Client for any loss that:</p>

        <ul style="margin-left: 20px;">
            <li>The Client may suffer as a result of Advisor’s investment advice or other action taken or omitted in good
                faith and with the degree of care, skill, prudence and diligence that a prudent person acting in a similar
                fiduciary capacity would use in conducting an enterprise of a similar nature and with similar objectives
                under the circumstances;</li>



            <li>Caused by any action or omission by the Custodian, any broker or dealer to which Advisor advice transactions
                for Client’s account or by any other third-party professionals or service providers.</li>
                </br>
                </br>
                
                </br>
                </br>

            <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
  </br>
                </br>

  </br>
                </br>

            <li>Resulting from the failure or delay in performance of any obligation under this Agreement arising out of or
                caused by circumstances beyond Advisor’s reasonable control, including, without limitation, acts of God,
                earthquakes, fires, floods, wars, terrorism, civil or military disturbances, sabotage, epidemics, riots,
                interruptions, loss or malfunctions of utility, computer software or hardware, Technical glitches from third
                parties ,transportation or communication service, accidents, labor disputes, acts of a civil or military
                authority;</li>
            <li>Investment in equities, derivatives etc. are subject to market risks and there is no assurance or guarantee
                that the objective of the services will be achieved.</li>
            <li>With any investment in Securities, the net asset value of the Portfolio can go up or down depending upon the
                factors and forces affecting the capital market.</li>
            <li>The performance may be affected by changes in Government policies, general levels of interest rates and risk
                associated with trading volumes, liquidity and settlement systems in markets.</li>
            <li>Force majeure events including index, futures, options and options contracts, warrants, convertible,
                Securities, swaps agreements or any other derivative instruments, including but not restricted to, for the
                purpose of hedging Portfolio balancing, as permitted under the Regulations.</li>
            <li>And guidelines will expose to certain risk inherent to such derivatives. The Client is aware that the
                derivatives are highly leveraged instruments and even a small price movement in the underlying security
                could have a large impact on their value.</li>
            <li>Investment in futures involves daily settlement of all positions. Every day the open positions are marked to
                market based on the closing level of the Index. The Index may move against the position that may have been
                assumed leading to Marked to Market losses; sometimes these may be substantial.</li>
            <li>Under certain market conditions, it may be difficult or impossible to execute transactions. There may be
                insufficient liquidity owing to factors including insufficient bids or offers or suspension of trading owing
                to other reasons. The Client acknowledges this liquidity risk.</li>
            <li>Buying an option carries a risk of losing the entire premium that is paid upfront on it, if the market in
                the security moves in a contrary direction to the position assumed.</li>
            <li>The Exchange may impose restrictions and have absolute authority to restrict the exercise of options in
                specified circumstances in specified times. This reflects that there is liquidity risk involved in
                Investment in options.</li>
            <li>The Option writer who sells the options runs the risk of losing substantial amount if the underlying asset
                does not move in the anticipated direction.</li>
            <li>Investment in Derivatives for the purposes of hedging is subject to Basis risk. Basis risk is the risk that
                the Instrument of the hedge is not a perfect match for the Underlying. The Client acknowledges this Basis
                risk.</li>
                
                  </br>
                  </br>
                  </br>
                  </br>
                  </br>
            </br>
              <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>

  </br>
            </br>
            <li>The Client expressly acknowledges that the aforementioned risks are strictly indicative and that other risks
                may arise in the context of investment in derivatives, particularly when positions are assumed
                synthetically, including for the purposes of generating returns.</li>
                
                
                
                
            <li>The Client expressly agrees and undertakes not to hold the Investment Advisor liable, financially or
                otherwise, in respect of the aforesaid under any circumstances.</li>

          
          
              </br>
            </br>
            <li>Dhruvin Bhanushali does not guarantee the future performance of the securities it advises or any specific
                level of performance, the success of any investment suggestion or strategy that it may use.</li>


            <li>Client understands that investment suggestions/advisory made for him/her by Dhruvin Bhanushali are subject
                to various market, currency, economic, political and business risks and that this investment advice shall
                not always be profitable. Client expressly agrees and undertake not to hold Dhruvin Bhanushali liable,
                financially or otherwise, in respect of any losses caused to him/her due to above mentioned various risks
                under any circumstances whatsoever without prejudice to the right of indemnity available to Dhruvin
                Bhanushali under any law, Client agrees to indemnify and hold Dhruvin Bhanushali harmless to the full extent
                against:
                <ol type="i" style="margin-left: 20px;">
                    <li>All losses, damages, liabilities, costs and expenses Client that incurs in connection with
                        investigation of, preparation for and defense of any pending or threatened claim and any litigation
                        or other proceeding arising out of or related to any actual or proposed acts done or not done on
                        Dhruvin Bhanushali's engagement hereunder.</li>
                    <li>Any negligence/mistake or misconduct by Client.</li>
                    <li>Any breach or non-compliance by the Client of the terms and conditions.</li>
                </ol>
            </li>
            <li>Advisor or its any employees or affiliates doesn’t provide any surety or guarantee of returns or profit in
                the market.</li>
            <li>The client is making payment for advisory services only. We do not take any kind of investments from
                clients, nor we handle any demat account.</li>
            <li>We request to all our clients to use Stop Loss and Target in every trade.</li>
            <li>The IA recommend that the client invest only from their disposable income. The IA do not recommend investing
                any monies by taking a loan or investing the entirety of the client’s savings. The client should invest only
                that amount which they can afford to lose in the market.</li>
        </ul>

        <br>
        Securities are volatile and prone to price fluctuations on a daily basis. The volatility in the value of the
        equity
        and equity related instruments is due to various micro and macro-economic factors affecting the securities
        markets. This may have adverse impact on individual securities /sector and consequently on the securities
        advised. Investments in stock market involve a higher degree of risk and investors should not invest in these
        securities unless they can afford to take the risks. 
        
           </br></br>
       <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
        </br></br>
        
        
        
        The IA may help client in educating him in regard to stock market through various third-party applications in
        which the client may share his Personal computer screen with the IA via third party software for remote
        access. The IA strictly advise the client to share only the screen of his Personal computer for viewing purpose
        only. The client should never provide default/full control of its Personal Computer to the IA or any of its
        employees/Affiliates on any event. If the client does this the whole responsibility
        
        
        
        
        of the same lies with the
        client only. Any grievance arising out of this should immediately be reported to the IA over
        compliance@growfortuna.com with proper documentations.

        <strong> 20. Client’s Responsibilities: </strong>Client agrees to deliver to Advisor a written statement of his or
        her investment
        objectives, policies and restrictions, as Advisor may reasonably require. Client also agrees to provide all
        corporate resolutions or similar documentation necessary to establish the undersigned’s authority to
        execute and deliver this Agreement. Client agrees to promptly deliver all amendments or supplements to
        these documents and agrees that Advisor will not be liable for any losses, costs, damages or claims arising
        out of Client’s failure to provide Advisor with any of these required documents, Client acknowledges that
        Advisor’s services to Client will depend upon the information that Advisor has concerning Client’s net
        worth, income, investment goals and objectives, ability to assume risk, income needs, tax situation and
        estate plan, and other similar information. Therefore, Advisor cannot adequately perform those services
        unless Client provides Advisor with this information and updates it with the advisor when it changes and
        otherwise diligently performs his or her responsibilities under this Agreement. Among other things, Client
        represents that the information set forth in the Risk profiling form is an accurate representation of his or
        her financial position and the investment needs for the account. Client will promptly inform Advisor of
        any significant changes in that information in writing. </br> </br> </br>
        <strong> 21. Description of Services: </strong>The Client and the Advisor each have duties and obligations under
        this
        Agreement. By signing this Agreement, the Client and the Advisor agree to perform the following:
        The Advisor agrees to deliver the following investment advice process</br> </br>

        a. DEFINE how the Advisor will work together with Client.</br></br>
        b. LEARN about Client and Client’s goals.</br></br>
        c. ANSWER Client’s questions.</br></br>
        d. ANALYZE individual stocks for possible acquisitions for Client’s portfolio.</br></br>
        e. CONSTRUCT an investment advice on individual stocks that the Advisor believes to generate
        favorable risk-adjusted investment returns for Client.</br></br>
        f. MEASURE, MANAGE, and REPORT to Client the progress of the investment advice provided.</br></br>
        
           <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>

        </br></br>
        </br></br>
        g. UPDATE Client’s strategy to accommodate changes.</br></br>
        
      
        h. The Principal Officers of Dhruvin Bhanushali who are rendering investment advice on behalf of
        Dhruvin Bhanushali fulfill minimum qualification and certification requirements as specified under
        regulation 7(1) and regulation 7(2) of Investment Advisor Regulations at all times
       
        i. Dhruvin Bhanushali complies with the KYC requirements specified by SEBI from time to time and
        relies upon on the KYC of the Client, as per the terms specified in SEBI {KYC (Know Your Client)
        Registration Agency} Regulations, 2011 and circulars issued thereunder. Client agrees to:</br></br>
        j. Provide all documents and information requested.</br></br>
        k. Provide the Advisor with written authorization whenever Client wishes the Advisor to disclose
        Client’s confidential information to third parties.</br></br>
        l. Inform the Advisor promptly about any changes in Clients personal financial situation.</br>

        </p>


        <br>
        <strong> Minimum Investment Amount: </strong> The client shall all time maintain in its Demat Account a minimum
        balance
        of Rs 20000/- (Twenty thousand Rupees Only). In case client changes its investment amount, he/she shall
        promptly inform the advisor.</br></br>
        <strong> 22. Means of communication: </strong> The advisor will render investment advice by the way of Short Message
        Service (SMS) Sender ID “GRWFUN”, Mobile application under Your recommendation section of
        Services tab and Calls only through their phone no. series (Refer Annexure II). Client shall only accept
        such advice which is provided to him/her by above registered SMS ID’s and Calling numbers only.
        Advisor shall not be liable if the client accepts the advice which is provided to him by any other means or
        any other number. Further client shall acknowledge any communication via mail through Advisor domain
        name only i.e. growfortuna.com. Advisor will not be liable for any email which is been received by client
        from any other domain name.</br></br>
        <strong> 23. Custody of Assets and Brokerage of transactions: </strong>Advisor shall not be liable to Client for any
        act,
        conduct or omission by the Custodian in its capacity as broker or custodian. Advisor shall not be
        responsible for ensuring Custodian’s compliance with the terms of the brokerage account or payment of
        brokerage or Custodian charges and fees. Client shall be responsible for brokerage expenses that are billed
        directly by the Custodian. The assets in the account remain in Client’s possession at all times and in the
        custody of the Custodian. At no time will the Advisor accept, maintain possession or have custodial
        responsibility for Client’s funds or securities. Client funds and securities will be delivered between Client
        and the Custodian only. If in case any person asks for access of the client’s account, the client shall not
        provide any access to that person and shall promptly inform the Advisor by writing a mail at
        complaince@growfortuna.com (compliance mail address).
        </br></br>

        <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
        </br></br>

        <strong>24. Non-Exclusivity:</strong> The Client acknowledges that Advisor shall be free to render investment advice
        to
        others and the advisor does not make its investment advisory services available exclusively to the Client.
        Client also understands that the Advisor provides investment advisory services to multiple clients with
        different economic needs and agrees that the Advisor may give advice and take action with respect to any
        of its other clients, which may differ from the advice given or the timing or action taken regarding the
        Client’s account. Nothing in this Agreement shall impose on the Advisor any obligation to the Client to
        purchase, sell or recommend for purchase or sale any security that the Advisor, its principals, affiliates,
        officers, members or employees may purchase or sell for their own accounts or for the account of any
        other client if in the sole and absolute discretion and reasonable opinion of the Advisor it is not for any
        reason practical or desirable to acquire a position in such security for Client’s account. Client understands
        that conflicts of interest could exist between Client’s account and other clients including with respect to
        the allocation of investment opportunities, time, and resources between Client and other clients. Advisor
        may determine in its sole discretion to allocate certain investment opportunities to its other clients and not
        the Client and vice versa. Although Advisor will use its best efforts to advice it’s all clients consistently,
        factors including date of account opening, account additions, withdrawals, and different investment
        choices which may lead to different investment advice for similarly situated clients. Client also acknowledges that
        the transactions in a specific security may not be accomplished for all clients at the
        same time at the same price.</br></br>
        </p>


        <p>

            <strong> 25. Confidentiality: </strong> information furnished by the Client to the Advisor including Client’s
            identity, shall
            be treated as confidential. The Advisor agrees not to voluntarily disclose confidential information without
            Clients prior consent (unless required by law, court order or agency directive, or unless the Advisor
            expects, in its reasonable opinion that it will be compelled by a court or government agency, or unless
            such information becomes publicly available or known other than as a result of actions of the Advisor). In
            such events the Advisor is compelled to disclose confidential information by legal process and the
            Advisor will attempt to give prior written notice of the same to Client.</br></br>
            <strong> 26. Legal, Tax and Accounting Advice:</strong> Client expressly understands and agrees that Advisor is
            not
            qualified to, and does not purport to provide, any legal, accounting, estate, actuary, or tax advice or to
            prepare any legal, accounting or tax documents. Nothing in this Agreement shall be construed as
            providing for such services. The Client will rely on his or her tax attorney or accountant for tax advice or
            tax preparation. Even if Advisor’s reports to the Client may be used to assist Client in preparing tax
            returns, the reports do not represent the advice or approval of tax professionals but, the Client may request
            Advisor to provide assistance in the coordination of estate and tax planning with Client’s designated estate
            and tax advisors. Client agrees to review the brokerage statements, transaction confirmations and tax
            reporting forms provided by the Custodian for tax-related information. Client acknowledges that any
            

            sales, exchanges or dispositions of securities may have federal and/or state income tax consequences for
            Client and may result in Client having to pay additional income taxes.
            
            
            
             <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>

        </br></br>
       

        <strong> 27. Indemnity:</strong> Client acknowledges that the Advisor’s investment recommendations involve some
        degree of
        risk. The Client acknowledges that all investment activity in Clients Account shall be at Client’s own risk,
        which can result in loss of Client’s investment capital, annual income, and/or tax benefits. Client
        acknowledges that the Advisor will not reimburse Client for any losses. Client acknowledges that the
        Advisor’s past performance of recommended investments should not be construed as an indication of
        future results, which may prove to be better or worse than the past. The Client acknowledges that the
        Advisor will immediately stop providing investment advisory services in the event that the Advisor has
        uncollected accounts receivable from Client for more than ten days.</br></br>
        <strong> 28. Disclosures:</strong> Client shall read the disclosure as mentioned over Annexure – I below and it
        can be changed
        without prior notice kindly check this section from time to time.</br></br>
        <strong> 29. Disclaimer:</strong> Investment Advisor Shall maintain records of interactions with Client,
        including prospective
        Client (prior to on-boarding), as per the guidelines provided under SEBI (Investment Advisers)
        Regulations, 2013.Investment Advisor shall maintain these records for a period of 5 (five) years.
        However, in case where a dispute has been raised, such records will be kept till its resolution or if SEBI
        desires that specific records be preserved, then such records will be kept till further intimation from the
        regulator. Only emails sent post onboarding of Client, from specific email IDs enlisted by Investment
        Advisor as recommendation desk will only be treated as ADVICE. Until that time, all conversations</br></br>
        between prospect and Investment Counseling team will be treated as consultations.</br></br>
        <strong> 30. Representation and covenants: </strong> In executing this engagement, I confirm that I am a
        ‘Registered
        Investment Adviser’ (RIA) under the Securities and Exchange Board of India (SEBI) (Investment
        Advisers) Regulations, 2013</br></br>
        <strong> 31. I have received all applicable regulatory/statutory approvals and undertake to maintain them
            throughout
            the validity of the advisory service.</strong> </br></br>
        <strong> 32. Death or disability of client:</strong> In case of the client’s disability/death during the period
        of engagement, the
        investment adviser will be in contact with the person/s as nominated by the client to assist them, provided
        written instructions are issued by the client in advance.</br></br>

        </p>

        <p>
            Principal Officer Contact details:</br></br>
            ● Name: Dhruvin Bhanushali</br></br>
            ● Email id: compliance@growfortuna.com
            
              <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
        </br></br>
            </br></br>
            ● Contact: +91 9930906921

      
        Grievance Redressal:</br></br>

        In case of any grievance, you can write to me at grievance@growfortuna.com</br></br>
        <strong>33. Severability: </strong> If any provision of this agreement shall be held or made invalid by a court
        decision, statute,
        rule or otherwise, the remainder of this agreement shall not be affected thereby.</br></br>
        <strong>34. Force Majeure: </strong> The Investment Adviser shall not be liable for delays or errors occurring
        by reason of
        circumstances beyond its control, including but not limited to acts of civil or military authority, national
        emergencies, work stoppages, fire, flood, catastrophe, acts of God, insurrection, war, riot, or failure of
        communication or power supply. In the event of equipment breakdowns beyond its control, the Advisor
        shall take reasonable steps to minimize service interruptions but shall have no liability with respect there
        to</br></br>
        <strong>35. Settlement of disputes and provision for Arbitration:</strong> Any controversy or claim arising out
        of or
        relating to this agreement, or the breach thereof may be settled by arbitration, and judgment upon the
        award rendered by the arbitrator(s) may be entered in any court having jurisdiction thereof. The Client
        understands that this agreement to arbitrate does not constitute a waiver of the right to seek a judicial
        forum where such waiver would be void under securities laws in force. Both parties should voluntarily
        agree to arbitration, arbitration is final and binding on the parties. All the disputes will be settled in
        Mumbai, Maharashtra jurisdiction.</br></br>
        <strong>36. Adherence to grievance redressal timelines: </strong>In case of any query or grievance, client
        should connect
        with the advisor over - Email id: grievance@growfortuna.com, Investment Advisor shall be responsible to
        resolve the grievances within the timelines specified under the SEBI circulars.</br></br>
        <strong> 37. MISCELLANEOUS:</strong>
        Alteration: Investment Advisor may from time to time amend the contract if required for complying with
        any change in statute, regulation or complying with press release or circular or with the requirements of
        any competent authority or if required under its corporate policies. Under such circumstances, the
        Investment Advisor will inform Client of such required changes through e-mail for the purpose of
        amending the present contract. On receipt of the notice, if Client is unwilling to continue with the present
        contract on amended terms and conditions Client shall intimate Investment Advisor within a period of 7
        days from the date of receipt of Notice. Client understand that, in case, Client agrees on above
        amendment, Client shall continue to deal with Investment Advisor subsequent to the receipt of such
        notice, it shall be deemed that Client is agreeable to the new clauses and under such circumstances; such
        amendment shall be effective and binding on Client from the date of receipt of intimation notice.
        
        </br>
        </br>
        </br>
        </br>
        </br>
        
        
        <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
        
        
        Notices: Any notice or other communication of like nature that may be given by one party to the other shall
        always be in writing and shall be served by hand delivery duly acknowledged or sent by registered post with

       
        acknowledgement due or through e-mail and by no other mode at the respective addresses of the parties or at
        such other address as may be subsequently intimated by one party to the other in writing. Any such
        communication shall be deemed to have been served when sent by registered post when the same is actually
        received by the addressee. In case of email, such communication shall be deemed to have been served when
        sent to the registered email id of the addressee. There shall be deemed acceptance of the communication in
        case of refusal/ evasion of service of the communication
        </p>


        <p>
            <strong> Know Your Customer (KYC):</strong> SEBI has enabled the usage of eSign, Digilocker and electronic
            signature as
            permitted by the Government of India under the Information Technology Act, 2000. The enablement of eSign,
            Digilocker and electronic signature would facilitate Client to submit their Officially Valid Documents (OVDs)
            (proof of identity and proof of address), for the purpose of KYC to the Investment Advisor online platform,
            through e-mail or electronic means. Client have provided all the necessary KYC information and undertake to
            comply with the KYC requirements on a continuous basis as and when asked for.
            Upon signing the agreement between the client and IA, the client is required to provide their PAN card details
            including PAN number and date of birth to IA. Failure to do so will result in the IA withholding services and
            the client being ineligible for a refund of the subscription fee.</br></br>
            ● Investment Advisor shall use sources/third parties for procuring esignatures of Clients.</br></br>
            ● Electronic signature: Client shall use eSign mechanism, which shall be accepted in lieu of wet</br></br>
            signature on the documents provided by Investment Advisor, eSign signature framework is operated
            under the 16 provisions of Second schedule of the Information Technology Act and guidelines issued
            by the controller.</br></br>
            IN WITNESS WHEREOF, the parties here to have executed the Agreement on the date of signing by the
            client, and the Agreement is effective on the date of acceptance by the Advisor.

        </p>
        <div style="display: flex;justify-content: space-between;">
            <p>Client’s Signature</p>
            <p> Investment Advisor</p>

        </div>
        </br>
        </br>
        </br>
        
       
        </br>
             </br>
        </br>
        </br>
        </br>
        </br>
        </br>
       



        <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
        <div style="text-align: center; font-weight: bold; font-size: 18px; ">
            Annexure I<br>
            DISCLOSURE DOCUMENT
        </div>

        <p style="text-align: justify;">
            The particulars given in this Disclosure Document have been prepared in accordance with SEBI (Investment
            Advisers) Regulations, 2013.
        </p>

        <p style="text-align: justify;">
            The purpose of the Document is to provide essential information about the Investment Advisory Services in a
            manner to assist and enable the prospective client/client in making an informed decision for engaging Investment
            Adviser before investing.
        </p>

        <p style="text-align: justify;">
            For the purpose of this Disclosure Document, Investment Adviser is Dhruvin Bhumashali.
        </p>

        <div>
            <p style="font-weight: bold;">A. Descriptions about Dhruvin Bhumashali:</p>

            <p style="font-weight: bold;">History, Present business and Background</p>
            <p style="text-align: justify;">
                Dhruvin Bhumashali was originally incorporated as Dhruvin Bhumashali on 22nd day of September 2019. Dhruvin
                Bhumashali is registered with SEBI as an Investment Adviser with Registration No. INA000019017. The focus of
                Dhruvin Bhumashali is to provide investment advice to the clients.
            </p>

            <p style="text-align: justify;">
                In the capacity as advisers Dhruvin Bhumashali aligns its interests with those of the client and seeks to
                provide the best suited advice based on client’s risk profile. Dhruvin Bhumashali first tries to understand
                the client’s return expectations, risk taking ability & goals, which in turn helps to arrive at an asset
                allocation suitable for the client. Dhruvin Bhumashali conducts frequent portfolio reviews and suggests any
                corrective actions if required.
            </p>

            <p style="text-align: justify;">
                Dhruvin Bhumashali Currently Dhruvin Bhumashali provides Investment advisory services only.
            </p>

            <p style="font-weight: bold;">B. Disclosures with respect to receipt of any consideration by way of remuneration
                or compensation or in any other form whatsoever, received or receivable by Dhruvin Bhumashali or any of its
                associates or subsidiary(ies) if any for any distribution or execution services in respect of the products
                or securities for which the investment advice is provided to the client:</p>

            <p style="text-align: justify;">
                Dhruvin Bhumashali do not have any distribution or execution arrangement with the issuers of the securities,
                that Dhruvin Bhumashali advises on. The fellow subsidiaries (if any) of Dhruvin Bhumashali may receive
                distribution commission/referral fee or similar income in respect of the products or securities for which
                investment advice is provided to the client by Dhruvin Bhumashali. The indicative commissions receivable by
                fellow subsidiaries (if any) are available on the website.
            </p>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>



            <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>



            <p style="font-weight: bold;">C. Disclosure of consideration by way of remuneration or compensation or in any
                form whatsoever with respect to recommending the services of stockbroker or other intermediary to a client:
            </p>

            <p style="text-align: justify;">
                Dhruvin Bhumashali and not recommend services of any stockbroker or intermediary to a client. Dhruvin
                Bhumashali does not have any commission sharing agreement with any stockbroker.
            </p>

            <p style="text-align: justify;">
                Dhruvin Bhumashali does not have any commission sharing agreement with any stockbroker or intermediary.
            </p>

            <p style="font-weight: bold;">D. Disclosures with respect to Dhruvin Bhumashali own holding position in
                financial products/securities:</p>

            <p style="">
                Although Dhruvin Bhanushali is registered as an investment advisor with SEBI, it is not actively engaged
                into any proprietary trading. It does not invest in any financial products / securities. However, Dhruvin
                Bhanushali may/not have positions in various mutual funds/liquid products. </br></br>
                E. Actual or potential conflicts of interest arising from any connection to or association with any issuer
                of
                products/ securities, including any material information or facts that might compromise its objectivity or
                independence in the carrying on of investment advisory services:</br></br>
                Dhruvin Bhanushali is a separate legal entity which has an independent activity of providing the
                Investment Advisory services. These services shall be provided by Dhruvin Bhanushali by maintaining an
                arm’s length relationship with its fellow subsidiaries (if any) which might engage in stock broking,
                depository, research, portfolio management and distribution of mutual funds and third-party products.
                Appropriate Chinese walls are also maintained in the manner as expected under SEBI IA Regulations.
                F. Disclosure of all material facts relating to the key features of the products or securities,
                particularly,
                performance track record, warnings, disclaimers etc.</br></br>
                Clients are requested to go through the detailed key features, performance track record of the product, or
                security including warnings, disclaimers etc. before investing as and when provided by the Investment
                Advisor. Such product materials may also be available to www.sebi.gov.in or www.nseindia.com or
                www.bseindia.com.
            </p>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>

            <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>

            G. Drawing client’s attention to warnings, disclaimers in documents, advertising materials relating to
            investment products.



            </br></br>
            
            
          
          
          
          

            </br></br>
            Dhruvin Bhanushali and the Advisers of Dhruvin Bhanushali who provide the investment advice on
            behalf of the concern to the clients, shall draw the client’s attention to the warnings, disclaimers in
            documents, advertising materials relating to an investment product/s which he/she/they is/are
            recommending to the client/s.



            H. Standard Risk Factors as perceived by Investment Adviser:

            1. Investments in equities and derivatives are subject to market risks and there is no assurance or
            guarantee that the objective of the investment / products will be achieved.</br></br>
            2. The past performance does not indicate its future performance. There is no assurance that past
            performances will be repeated. Investors are not being offered any guaranteed or indicative
            returns.</br></br>
            3. The performance of the investments/products may be affected by changes in Government policies,
            general levels of interest rates and risks associated with trading volumes, liquidity and settlement
            systems in equity and debt markets.</br></br>
            4. Investments in the products which the Clients have opted are subject to wide range of risks which
            inter alia also include but not limited to economic slowdown, volatility & illiquidity of the stocks,
            poor corporate performance, economic policies, changes of Government and its policies, acts of
            God, acts of war, civil disturbance, sovereign action and /or such other acts/ circumstance beyond
            the control of Dhruvin Bhanushali or any of its fellow subsidiaries.</br></br>
            5. The names of the products/nature of investments do not in any manner indicate their prospects or
            returns. The performance in the equity products may be adversely affected by the performance of
            individual companies, changes in the marketplace and industry specific and macro-economic
            factors.</br></br>
            6. Investments in debt instruments and other fixed income securities are subject to default risk,
            liquidity risk and interest rate risk. Interest rate risk results from changes in demand and supply
            for money and other macroeconomic factors and creates price changes in the value of the debt
            instruments. Consequently, the NAV of the portfolio may be subject to the fluctuation.</br>
            7. Investments in debt instruments are subject to reinvestment risks as interest rates prevailing on
            interest amount or maturity due dates may differ from the original coupon of the bond, which
            might result in the proceeds being invested at a lower rate.</br></br>
            8. Engaging in securities lending is subject to risks related to fluctuations in collateral value /
            settlement/ liquidity/counter party.
            </br>
            </br>
            </br>
            </br>

          
            9. The product may use derivatives instruments like index futures, stock futures and options
            contracts, warrants, convertible securities, swap agreements or any other derivative instruments.
            Usage of derivatives will expose portfolio to certain risk inherent to such derivatives.</br></br>
            10. The use of derivative requires a high degree of skill, diligence and expertise. Thus, derivatives are
            highly leveraged instruments. Small price movement in the underlying security could have a large
            impact on their value. Other risks in using derivatives include the risk of mis-pricing or improper
            valuation of derivatives and the inability of derivatives to correlate perfectly with underlying
            assets, rates and indices.</br></br>
            11. The Investment Advisor may, considering the overall level of risk of the portfolio, advice for
            investment in lower rated/unrated securities offering higher yield. This may increase the risk of
            the portfolio. Such investments shall be subject to the scope of investments as laid down in the
            Agreement.</br></br>
            General Risks: We trust that, before executing on the advice of the Investment Adviser, our Relationship
            Manager at Dhruvin Bhanushali has provided you with all the information about the products, risk factors
            etc.</br></br>
            and you have gone through all the relevant information about the product being advised and have sought
            requisite clarification about the same.</br></br>
            Dhruvin Bhanushali shall maintain complete confidentiality of all information provided by the client/s and
            shall not disclose any such information, without your prior consent except if such disclosure is required to
            be</br></br>
            made in compliance with any applicable law or regulatory direction. Dhruvin Bhanushali will obtain
            information pertaining to your orders/transactions/portfolio/fund’s availability/securities availability
            etc. from
            the individual Client to enable us to provide you with informed and appropriate advice.</br></br>
            Investors Services: The detail of investor relation officer who shall attend to the investor queries and
            complaints is mentioned below:</br></br>
            ● Name of the person: Dhruvin Bhanushali</br></br>
            ● Address: 1102 C-Wing, Olive Apt, Neptune Colourscape, Mulund West, Mumbai 400080</br></br>
            ● Telephone: +91 8767422422</br></br>
            ● Email: compliances@growfortuna.com</br></br>
            
            
            </br></br>
            </br></br>
            </br></br>
            </br></br>

            </p>

            <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
        </div>

        <div style="text-align: center; font-weight: bold; font-size: 18px; ">
            Annexure II<br>
            In case of any grievances the investor may email to grievance@growfortuna.com<br>General terms & conditions


        </div>
        <p>
            Investment advisory office timings: 9:00 A.M to 4:00 P.M (Monday - Friday).</br></br> Investment advisory Hotline
            numbers & timings: [+91 9930906921] 0:00 A.M to 4:00 P.M (Monday - Friday).</br></br>
            Investment Advisory advice taking numbers & timings: [+91 9930906921] 9:00 A.M to 4:00 P.M (Monday -
            Friday). </br></br>
            Market recommendation SMS sender ID: “GRWFUN”</br></br>
            Investment advisory Grievance number & timings: +91 9930906921 11:00 A.M to 4:00 P.M (Monday to
            Friday)</br></br>
            Important Email addresses: For Service-related issues: service@growfortuna.com</br></br>
            For Compliance related issues: compliance@growfortuna.com</br></br>
            For Grievance related issues: grievance@growfortuna.com</br></br>
            For Feedback: service@growfortuna.com</br></br>
            How to approach grievance officer: Illustration</br></br>
            For any grievance of the client, they can always connect with the grievance team.</br></br>
            1. Before going to any other platform over the investment advisor’s email address of
            grievance@growfortuna.com</br></br>
            2. The grievance team will study the complaint of the client and will respond to that within a
            maximum internal timeframe of 72 working hours.</br></br>
            3. For complaints or grievances put on any other platform apart from the Investment advisor’s
            internal grievance redressal platform will be dealt as per the procedure and the timelines specified
            under the SEBI circulars.</br></br>
            In any case the client is not satisfied by the response of the Advisor they can always approach the SEBI Scores
            platform for their respective complaint redressal at https://scores.gov.in/scores/Welcome.html
            Investment advisory product recommendation frequency:
                    </br></br>

        </br></br>


        <div class="defaulthide" style="color:gray;font-size:10px;margin-left: 90px;text-align:center;width:80%;">
    <p style="">


        *Kindly refer Annexure I (Probable situation in the stock market end of this document)
   
    </br>
    </br>

        Advisor
        www.growfortuna.com E : info@growfortuna.com
    </p>

</div>
        </br></br>
        </br></br>
        ● For Intraday (During a day): Expect 1 or 2 recommendations/day.</br>
        ● For Short term (Days to Week): Expect 2 or 3 recommendations/week.</br>
        ● For Medium term (Weeks to Month): Expect 2 or 4 recommendations/month.</br>
        ● For Long Term (Months to Year): Expect 1 recommendation/ Month.</br></br></br>
        This call/recommendation frequency is subject to change as per the discretion of the
        Investment Advisor depending on the market conditions. Any change will be communicated to the client on
        time-to-time basis over their registered contact details.</br>
        In case the Investment Advisor is trying to connect with the client through SMS/Calls/Emails over his
        registered contact number & email address and if the same is not answered continuously in any form, then
        those passing days will be counted as his service days only.</br>
        </p>
        <table style="border-collapse: collapse; width: 100%; border: 1px solid black;">
            <tr>
                <td colspan="4" style="text-align: center; font-weight: bold; border: 1px solid black; padding: 10px;">Risk Assessment Score</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 10px;">Name</td>
                <td colspan="3" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->name ?? ''}}</b></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 10px;">Risk Score</td>
                <td colspan="3" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->totalpoints ?? ''}}</b></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 10px;">Mobile Type</td>
                <td colspan="3" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->phone ?? ''}}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black; padding: 10px;">Have you previously taken trading advisory from any other Investment Advisory Firm?</td>
                <td colspan="2" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->previous_advisory ?? ''}}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black; padding: 10px;">Advisory Firm Name</td>
                <td colspan="2" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->firm ?? ''}}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black; padding: 10px;">Have you previously had a loss in Trading?</td>
                <td colspan="2" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->previous_loss ?? ''}}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black; padding: 10px;">If YES, then what is the Loss Percentage (%) as per the Capital Value?</td>
                <td colspan="2" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->loss_percentage ?? ''}}</b></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 10px;">What is Your Liability / Borrowing Details?</td>
                <td colspan="3" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->liability ?? ''}}</b></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 10px;">Other Liability / Borrowing Details?</td>
                <td colspan="3" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->other_Liability ?? ''}}</b></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 10px;">What is Your age?</td>
                <td colspan="3" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->age ?? ''}}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black; padding: 10px;">Have you ever traded in the stock market? If yes, then select the segment.</td>
                <td colspan="2" style="border: 1px solid black; padding: 10px;"><b style="color: blue;">{{$risk['riskmodel']->ever_did_trade ?? ''}}</b></td>
            </tr>
            @if(!empty($risk['questions']))
            @foreach($risk['questions'] as $key => $listing)
            <tr>
                <td colspan="5" style="text-align: center; font-weight: bold; border: 1px solid black; padding: 10px;">{{ $listing->question ?? '' }}</td>
            </tr>

            @if(!$listing->subquestions->isEmpty())
            @php $subQuestionCount = 0; @endphp
            @foreach($listing->subquestions as $subquestionlist)
            @php $subQuestionCount++; @endphp
            <tr>
                <td colspan="5" style="text-align: center; font-weight: bold; border: 1px solid black; padding: 10px;">{{ $subQuestionCount }}. {{ $subquestionlist->question ?? '' }}</td>
            </tr>

            @if(!empty($subquestionlist->options))
            @php $optionCount = 0; @endphp
            @foreach($subquestionlist->options as $option)
            @php $optionCount++; @endphp
            <tr>
                <td style="border: 1px solid black; padding: 10px;">{{ $subQuestionCount }}.{{ $optionCount }}. {{ $option->option ?? '' }}</td>
                <td style="border: 1px solid black; padding: 10px;">
                    @php
                    $answer = $risk['answers']->first(function($answer) use ($listing, $subquestionlist, $option) {
                    return $answer->question_id == $listing->id
                    && $answer->subquestion_id == $subquestionlist->id
                    && $answer->option_id == $option->id;
                    });
                    @endphp
                    <b style="color:blue;"> {{ $answer->option ?? '' }} </b>
                </td>
            </tr>
            <tr></tr>
            @endforeach
            @endif
            @endforeach
            @else
            @if(!empty($listing->options))
            @php $optionCount = 0; @endphp
            @foreach($listing->options as $option)
            @php $optionCount++; @endphp
            <tr>
                <td style="border: 1px solid black; padding: 10px;">{{ $optionCount }}. {{ $option->option ?? '' }}</td>
                <td style="border: 1px solid black; padding: 10px;">
                    @php
                    $answer = $risk['answers']->first(function($answer) use ($listing, $option) {
                    return $answer->question_id == $listing->id
                    && $answer->option_id == $option->id;
                    });
                    @endphp
                    <b style="color:blue;"> {{ $answer->option ?? '' }} </b>
                </td>
            </tr>
            @endforeach
            @endif
            @endif
            @endforeach
            @endif
        </table>
        <p style="padding: 10px;">*According to your risk profile your risk score is High Risk, the product suitability pdf is attached with the mail.</p>
        <p style="padding: 10px;">**The questions in the Risk profile management have a certain weight of score. Moreover, a few questions, like No. 1, 2, & 7, will be independent of the category depending on the total score.</p>



















    </div>
    </div>
    <div class="footer">
        <!--Footer Content - Page <span class="pageNumber"></span>-->
    </div>
</body>


</html>