<?php
	$seleccion="";
	
if($pantallaE <> null)
{

    	for($i=0; $i<count($pantallas); $i++)
    	{
    	    echo"<tr>";
    		for($j=0; $j<count($pantallaE); $j++)
    		{
    			$seleccion="";		
    			if($i<count($pantallas))
    			{
    			   if($pantallas[$i][1]==$pantallaE[$j][0] )
        			{
        				$seleccion="checked";
        			
        			}
    				echo'<td>
    					<input type="checkbox" name="funEmpleado[]" class="checkmios"'.$seleccion.' value="'.$pantallas[$i][1].'">'.$pantallas[$i][0] .'<br>
    				</td>';
    			
    				 
    			}
    			$i++;
    			
    			if($i<count($pantallas))
    			{
    			   //echo"<br> llego j tiene $j-->".$pantallas[$i][1]." == ".$pantallaE[$j][0];	
    			   if($pantallas[$i][1]==$pantallaE[$j][0] )
        			{
        				$seleccion="checked";
        			
        			}
    				echo'<td>
    					<input type="checkbox" name="funEmpleado[]" class="checkmios"'.$seleccion.' value="'.$pantallas[$i][1].'">'.$pantallas[$i][0] .'<br>
    				</td>';
    			
    				 
    			}
    			$i++;
    			
    		    if($i<count($pantallas))
    			{
    			   
    			   if($pantallas[$i][1]==$pantallaE[$j][0] )
        			{
        				$seleccion="checked";
        			
        			}
    				echo'<td>
    					<input type="checkbox" name="funEmpleado[]" class="checkmios"'.$seleccion.' value="'.$pantallas[$i][1].'">'.$pantallas[$i][0] .'<br>
    				</td>';
    				
    			}
    			$i++;
    			
    			if($i<count($pantallas))
    			{
    			   
    			   if($pantallas[$i][1]==$pantallaE[$j][0] )
        			{
        				$seleccion="checked";
        			
        			}
    				echo'<td>
    					<input type="checkbox" name="funEmpleado[]" class="checkmios"'.$seleccion.' value="'.$pantallas[$i][1].'">'.$pantallas[$i][0] .'<br>
    				</td>';
    			
    				 
    			}
    			$i++;	
    			
    		}
    		//dd($$pantallaE);
    	echo"</tr>";
    		$seleccion="";
    	}
}
else
{
	for($i=0; $i<count($pantallas); $i++)
	{
		?>											
		<tr>
			<td>
				<input type="checkbox" name="funEmpleado[]" class="checkmios" value="<?php echo $pantallas[$i][1] ?>"> <?php echo $pantallas[$i][0] ?><br>
				
			</td>
		<?php
			$i++;
			if($i<count($pantallas))
			{
				echo'<td>
					<input type="checkbox" name="funEmpleado[]" class="checkmios" value="<?php $i++; echo $pantallas[$i][1] ?>">'.$pantallas[$i][0] .'<br>
				</td>';
			}
			
			$i++;
			if($i<count($pantallas))
			{
				echo'<td>
					<input type="checkbox" name="funEmpleado[]" class="checkmios" value="<?php $i++; echo $pantallas[$i][1] ?>">'.$pantallas[$i][0] .'<br>
				</td>';
			}
			
			$i++;
			if($i<count($pantallas))
			{
				echo'<td>
					<input type="checkbox" name="funEmpleado[]" class="checkmios" value="<?php $i++; echo $pantallas[$i][1] ?>">'.$pantallas[$i][0] .'<br>
				</td>';
			}
	}
}


?>