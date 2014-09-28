<div style="border-color: #407BAF;border-style: solid;border-width: 2px;background-color: #FAFBFC;vertical-align: middle;height:190px;">

    <div class="section-title" ><center>Equipment Tests for <?php echo $this -> session -> userdata('filter_desc');?> </center></div>

    <div id="equipment-tests-tbl">
        <table style = "border: 1px solid #DDD;">
            <thead class="even" style="background:#f0f0f0" >
                <tr>
                    <td>Device</td>
                    <td>Total Tests</td>
                    <td>Successful Tests</td>
                    <td>Errors</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($equipment_tests as $eq) {
                ?>
                <tr style = "border: 1px solid #DDD;" >
                    <td style="background-color: #F6F6F6;"  ><center><a href=""><?php echo $eq["equipment"];?></a></center></td>
                    <td style="background-color: #F6F6F6;" ><center><?php echo $eq["count"];?></center></td>
                    <td style="background-color: #F6F6F6;" ><center><?php echo $eq["valid"];?></center></td>
                    <td style="background-color: #F6F6F6;" ><center><?php echo $eq["errors"];?></center></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>