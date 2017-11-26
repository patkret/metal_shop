<header class="shop-header">
    <div class="auth-panel">
        <ul>
            <li><a href="#"><img src="\images\photo\me.png"> MOJE KONTO</a></li>
            <li><a href="#">POMOC</a></li>
            <li><a href="#"><img src="\images\photo\basket.png"></a></li>
        </ul>
    </div>

    <div id="menuToggle">
        <!--
        A fake / hidden checkbox is used as click reciever,
        so you can use the :checked selector on it.
        -->

        <input title="menu" type="checkbox"/>

        <!--
        Some spans to act as a hamburger.

        They are acting like a real hamburger,
        not that McDonalds stuff.
        -->
        <span></span>
        <span></span>
        <span></span>

        <!--
        Too bad the menu has to be inside of the button
        but hey, it's pure CSS magic.
        -->
        <ul id="menu">
            <li><a href="#">ELEMENTY ZŁĄCZNE</a></li>
            <li><a href="#">OSPRZĘT ŻEGLARSKI</a></li>
            <li><a href="#">NARZĘDZIA</a></li>
            <li><a href="#">CHEMIA</a></li>

        </ul>
    </div>

    <div class="line"></div>
    <div class="logo-image">
        <img src="\images\logo\sygnet.png">
    </div>
    <div class="logo-text">
        HURTMET pl
    </div>
    <div class="nav-categories">
        <ul>
            <li><a href="#">ELEMENTY ZŁĄCZNE</a></li>
            <li><a href="#">OSPRZĘT ŻEGLARSKI</a></li>
            <li><a href="#">NARZĘDZIA</a></li>
            <li><a href="#">CHEMIA</a></li>
        </ul>
    </div>
    <div class="search-bar">
        <form>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Szukaj">
                <span class="input-group-btn">
                     <button class="btn btn-default" type="button"><i class="fa fa-search"
                                                                      aria-hidden="true"></i></button>
                 </span>
            </div>
        </form>
    </div>
    <div class="end-line"></div>
</header>