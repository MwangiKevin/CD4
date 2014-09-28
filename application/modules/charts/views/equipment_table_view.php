<div style="border-color: #407BAF;border-style: solid;border-width: 2px;background-color: #FAFBFC;vertical-align: middle;height:195px;">
    
    <div class="section-title" ><center>CD4 Equipment </center></div>

    <div id="equipment-tbl">
        <table style = "border: 1px solid #DDD;">
            <thead class="even" style="background:#f0f0f0" >
                <tr>
                    <td>Device</td>
                    <td>Total</td>
                    <td>Functional</td>
                    <td>Broken down</td>
                    <td>Obsolete</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($devices as $dev) {
                    ?>
                    <tr style = "border: 1px solid #DDD;" >
                        <td style="background-color: #CCCCCC;"  ><center><a href=""><?php echo $dev["equipment"];?></a></center></td>
                        <td style="background-color: #F6F6F6;;" ><center><?php echo $dev["total"];?></center></td>
                        <td style="background-color: #F6F6F6;;" ><center><?php echo $dev["functional"];?></center></td>
                        <td style="background-color: #F6F6F6;;" ><center><?php echo $dev["broken_down"];?></center></td>
                        <td style="background-color: #F6F6F6;;" ><center><?php echo $dev["obsolete"];?></center></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>