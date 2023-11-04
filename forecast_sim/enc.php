<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <form method="post">
        <label for="action">Choose Action:</label>
        <select name="action" id="action">
            <option value="encode">Encode</option>
            <option value="decode">Decode</option>
        </select><br><br><br>
        <textarea name="data" id="data" rows="20" cols="100"></textarea><br>
        <input type="submit"  value="Submit">
    </form>
    <h2>Output:</h2>
    <div id="output">
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $data = $_POST["data"];
 $encode = base64_decode($data);
    
    function caesarEncode($input, $shift) {
        $output = '';
        $length = strlen($input);
        for ($i = 0; $i < $length; $i++) {
            $char = $input[$i];
            if (ctype_alpha($char)) {
                $isUpperCase = ctype_upper($char);
                $asciiOffset = $isUpperCase ? 65 : 97;
                $encodedAscii = ($isUpperCase ? 65 : 97) + ((ord($char) - $asciiOffset + $shift) % 26);
                $output .= chr($encodedAscii);
            } else {
                $output .= $char;
            }
        }
        return $output;
    }
    
    function caesarDecode($input, $shift) {
        return caesarEncode($input, 26 - $shift);
    }
    
    if ($action == "encode") {
        $encodedData = caesarEncode($data, 3); // Shift by 3

        echo base64_encode($encodedData);

    } elseif ($action == "decode") {
        $decodedData = caesarDecode($encode, 3);
        
        echo "<pre>".htmlentities($decodedData)."</pre>";
    }
}
?>
<!-- 
Step1: open this file and place all code in the text field
Step2: then copy the encoded code and paste into base64encode
Step3: then copy the code and paste into variable  -->

    </div>
</body>
</html>
