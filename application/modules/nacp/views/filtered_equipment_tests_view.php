<div id="equipment-tests-table">
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
                foreach ($filtered_equipment as $eq) {
            ?>
            <tr style = "border: 1px solid #DDD;" >
                <td style="background-color: #CCCCCC;"  ><center><a href=""><?php echo $eq["equipment"];?></a></center></td>
                <td style="background-color: #F6F6F6;;" ><center><?php echo $eq["count"];?></center></td>
                <td style="background-color: #F6F6F6;;" ><center><?php echo $eq["valid"];?></center></td>
                <td style="background-color: #F6F6F6;;" ><center><?php echo $eq["errors"];?></center></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
