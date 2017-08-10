<div id="breadCrumb">
    <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
</div>

<div id="centralizar">
    <div id="slideshow">
        <div id="wowslider-container1">
            <div class="ws_images"><ul>
                    <?php $pag->banner(); ?>
                </ul></div>
            <div class="ws_shadow"></div>
        </div>
        <script type="text/javascript" src="<?php echo BASEURL; ?>js/jquery/banner/engine1/wowslider.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL; ?>js/jquery/banner/engine1/script.js"></script>
    </div>

    <div id="boxShow">
        <div class="shows">
            <div class="carousels">
                <?php $pag->ultimosDestaques(); ?>
            </div>

            <div class="carousels">
                <?php $pag->maisRecentes(); ?>
            </div>

            <div class="carousels">
                <?php $pag->maisComprados(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        var owl1 = $("#carousel1");

        owl1.owlCarousel({
            itemsCustom: [
                [0, 5],
                [450, 5],
                [600, 5],
                [700, 5],
                [1000, 5],
                [1200, 5],
                [1400, 5],
                [1600, 5]
            ],
            navigation: false
        });

        var owl2 = $("#carousel2");

        owl2.owlCarousel({
            itemsCustom: [
                [0, 5],
                [450, 5],
                [600, 5],
                [700, 5],
                [1000, 5],
                [1200, 5],
                [1400, 5],
                [1600, 5]
            ],
            navigation: false
        });


        var owl3 = $("#carousel3");

        owl3.owlCarousel({
            itemsCustom: [
                [0, 5],
                [450, 5],
                [600, 5],
                [700, 5],
                [1000, 5],
                [1200, 5],
                [1400, 5],
                [1600, 5]
            ],
            navigation: false
        });


    });
</script>