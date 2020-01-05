<?php
print_r($ligas);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h3>Paises</h3>
            <ul class="list-group">
                <?php
                    foreach ($ligas as $item){ ?>

                        <a href="<?php echo base_url('futebol/ligas/').$item['slug_pais']."/".$item['slug_liga'] ;?>" style="text-decoration: none; color: #333333">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $item['nome_liga'];?>
                                <span class="flag-icon flag-icon-<?php echo $item['flag'];?>"></span>
                            </li>
                        </a>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
