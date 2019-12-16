<?php
/**
 * Telephone Call Router - PHP Application
 *
 * @category   PHP_Application
 * @package    telephone-call-router
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 **/

/**
 * Prepare price-list according to operators
 * @return available operators and their price lists
 */
function getTelephoneOperators(){
    return array(
        "Operator-A" => array(
            "1" => 0.9,
            "268" => 5.1,
            "46" => 0.17,
            "4620" => 0.0,
            "468" => 0.15,
            "4631" => 0.15,
            "4673" => 0.9,
            "46732" => 1.1
        ),
        "Operator-B" => array(
            "1" => 0.92,
            "44" => 0.5,
            "46" => 0.2,
            "467" => 1.0,
            "48" => 1.2
        ),
//        // Uncomment Operator-C and Operator-D if you want to check with more operators
//        "Operator-C" => array(
//            "1" => 2.0,
//            "44" => 1.0,
//            "46" => 3.0,
//            "46725" => 4.0,
//            "467" => 1.2,
//            "4672" => 2.0
//        ),
//        "Operator-D" => array(
//            "46" => 4.0,
//            "467" => 2.0,
//            "46725" => 3.0,
//            "4672" => 1.0,
//            "48" => 3.0
//        )
    );
}

/**
 * Calculate the cheapest operator
 * @param type $matchedItems
 * @return type $result
 */
function calculateCheapestCallRate($matchedItems) {
    // Necessary variables initialization
    $result = array();
    $cheapestOperator = "";
    $cheapestPrice = 999999.0;

    // Iterate throgh the mapped items and find the cheapest price
    foreach ( $matchedItems as $operator => $price ):
        if ( $price < $cheapestPrice ) {
            $cheapestPrice = $price;
            $cheapestOperator = $operator;
        }
    endforeach;

    ## Return result
    $result[0] = $cheapestOperator;
    $result[1] = $cheapestPrice;
    return $result;
}

##################### Program Execution Starts From Here #####################
if ( isset($_POST['phone_number']) && !empty($_POST['phone_number']) ) {
    // User given telephone number
    $phoneNumber = trim($_POST['phone_number']);
    $phoneNumber = preg_replace("/\D/", "", $phoneNumber);
    
    // Prepare price-list according to operators
    $operators = getTelephoneOperators();
    
    // Iterate all the existing price-lists according to operators
    // Explore all the price items, and calculate the cheapest one
    $matchedItems = array();
    foreach ( $operators as $operatorName => $operatorItem ):
        // Necessary variables initialization
        $maxPrefixLength = 0;
        $leastPrice = 0.0;
        $leastPrefix = "null";

        // Iterate through the available operators and explore their price-list
        foreach ( $operatorItem as $prefix => $price ):
            // Check if the prefix matches the number or not.
            // Check if the previously matched prefix length
            // is smaller than the currently matched prefix length
            // We will consider the maximum-length matched prefix
            if ( preg_match("/^{$prefix}(.*)/", $phoneNumber) 
                    && ($maxPrefixLength < strlen($prefix)) ) {
                $leastPrefix = $prefix;
                $leastPrice = $price;
                $maxPrefixLength = strlen($prefix);
            }            
        endforeach;
        
        // Prepare least-price object as per operator
        if ( $leastPrefix != "null" ) {
            $matchedItems[$operatorName] = $leastPrice;
        }
        
    endforeach;
    
    // List down the found least-price operators
    $totalMatchedItems = count($matchedItems);
    if ( $totalMatchedItems > 0 ) {
        echo("<br />-------------------------------------------------------------------------------------------------------------<br />");
        echo ("<br />Total {$totalMatchedItems} operator(s) found for the number \"{$phoneNumber}\"<br />");
        foreach ( $matchedItems as $operator => $price ):
            echo("<br />=> {$operator} offers $ {$price}/minute");
        endforeach;
    }
    
    // Calculate the cheapest operator among the cheaps
    echo("<br /><br />-------------------------------------------------------------------------------------------------------------<br /><br />");

    // Get cheapest call rate
    $result = calculateCheapestCallRate($matchedItems);
    if ( !empty($result[0]) ) {
        echo("Cheapest operator is \"{$result[0]}\", which offers $ {$result[1]}/minute<br />");
    } else {
        echo("Sorry, no operator found!<br />");
    }
} else {
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="phone_number">Enter Telephone Number:</label>
    <input type="text" name="phone_number" id="phone_number" value="" />
    <button type="submit">Find Cheapest Rate</button>
</form>
<?php } ?>