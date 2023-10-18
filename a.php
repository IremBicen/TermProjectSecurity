<?php
error_reporting(0);
// Initial Permutation Table
$IP=[ 58, 50, 42, 34, 26, 18, 10, 2,  60, 52, 44,
      36, 28, 20, 12, 4,  62, 54, 46, 38, 30, 22,
      14, 6,  64, 56, 48, 40, 32, 24, 16, 8,  57,
      49, 41, 33, 25, 17, 9,  1,  59, 51, 43, 35,
      27, 19, 11, 3,  61, 53, 45, 37, 29, 21, 13,
      5,  63, 55, 47, 39, 31, 23, 15, 7 ];
 
// Inverse Initial Permutation Table
$IP1= [ 40, 8,  48, 16, 56, 24, 64, 32, 39, 7,  47,
        15, 55, 23, 63, 31, 38, 6,  46, 14, 54, 22,
        62, 30, 37, 5,  45, 13, 53, 21, 61, 29, 36,
        4,  44, 12, 52, 20, 60, 28, 35, 3,  43, 11,
        51, 19, 59, 27, 34, 2,  42, 10, 50, 18, 58,
        26, 33, 1,  41, 9,  49, 17, 57, 25 ];
 
// first key-hePermutation Table
$PC1 = [ 57, 49, 41, 33, 25, 17, 9,  1,  58, 50,
        42, 34, 26, 18, 10, 2,  59, 51, 43, 35,
        27, 19, 11, 3,  60, 52, 44, 36, 63, 55,
        47, 39, 31, 23, 15, 7,  62, 54, 46, 38,
        30, 22, 14, 6,  61, 53, 45, 37, 29, 21,
        13, 5,  28, 20, 12, 4 ];

// second key-Permutation Table
$PC2= [ 14, 17, 11, 24, 1,  5,  3,  28, 15, 6,
        21, 10, 23, 19, 12, 4,  26, 8,  16, 7,
        27, 20, 13, 2,  41, 52, 31, 37, 47, 55,
        30, 40, 51, 45, 33, 48, 44, 49, 39, 56,
        34, 53, 46, 42, 50, 36, 29, 32 ];
 
// Expansion D-box Table
$EP = [ 32, 1,  2,  3,  4,  5,  4,  5,  6,  7,
        8,  9,  8,  9,  10, 11, 12, 13, 12, 13,
        14, 15, 16, 17, 16, 17, 18, 19, 20, 21,
        20, 21, 22, 23, 24, 25, 24, 25, 26, 27,
        28, 29, 28, 29, 30, 31, 32, 1 ];
 
// Straight Permutation Table
$P= [ 16, 7, 20, 21, 29, 12, 28, 17, 1,  15, 23,
      26, 5, 18, 31, 10, 2,  8,  24, 14, 32, 27,
       3,  9, 19, 13, 30, 6,  22, 11, 4,  25 ];
 
// S-box Table
$sbox= [ [ [ 14, 4, 13, 1, 2, 15, 11, 8, 3, 10, 6,  12, 5, 9, 0, 7 ],
           [ 0, 15, 7, 4, 14, 2, 13, 1, 10, 6, 12, 11, 9, 5, 3, 8 ],
           [ 4, 1, 14, 8, 13, 6, 2, 11, 15, 12, 9, 7, 3, 10, 5, 0 ],
           [ 15, 12, 8, 2, 4, 9, 1, 7, 5, 11, 3, 14, 10, 0, 6, 13 ] ],
 
         [ [ 15, 1, 8, 14, 6, 11, 3, 4, 9, 7, 2, 13, 12, 0, 5, 10 ],
           [ 3, 13, 4, 7, 15, 2, 8, 14, 12, 0, 1, 10, 6, 9, 11, 5 ],
           [ 0, 14, 7, 11, 10, 4, 13, 1, 5, 8, 12, 6, 9, 3, 2, 15 ],
           [ 13, 8, 10, 1, 3, 15, 4, 2, 11, 6, 7, 12, 0, 5, 14, 9 ] ],
				  
         [ [ 10, 0, 9, 14, 6, 3, 15, 5, 1, 13, 12, 7, 11, 4, 2, 8 ],
           [ 13, 7, 0, 9, 3, 4, 6, 10, 2, 8, 5, 14, 12, 11, 15, 1 ],
           [ 13, 6, 4, 9, 8, 15, 3, 0, 11, 1, 2, 12, 5, 10, 14, 7 ],
           [ 1, 10, 13, 0, 6, 9, 8, 7, 4, 15, 14, 3, 11, 5, 2, 12 ] ],
		 
         [ [ 7, 13, 14, 3, 0, 6, 9, 10, 1, 2, 8, 5, 11, 12, 4, 15 ],
           [ 13, 8, 11, 5, 6, 15, 0, 3, 4, 7, 2, 12, 1, 10, 14, 9 ],
           [ 10, 6, 9, 0, 12, 11, 7, 13, 15, 1, 3, 14, 5, 2, 8, 4 ],
           [ 3, 15, 0, 6, 10, 1, 13, 8, 9, 4, 5, 11, 12, 7, 2, 14 ] ],
		  
         [ [ 2, 12, 4, 1, 7, 10, 11, 6, 8, 5, 3, 15, 13, 0, 14, 9 ],
           [ 14, 11, 2, 12, 4, 7, 13, 1, 5, 0, 15, 10, 3, 9, 8, 6 ],
           [ 4, 2, 1, 11, 10, 13, 7, 8, 15, 9, 12, 5, 6, 3, 0, 14 ],
           [ 11, 8, 12, 7, 1, 14, 2, 13, 6, 15, 0, 9, 10, 4, 5, 3 ] ],
				  
         [ [ 12, 1, 10, 15, 9, 2, 6, 8, 0, 13, 3, 4, 14, 7, 5, 11 ],
           [ 10, 15, 4, 2, 7, 12, 9, 5, 6, 1, 13, 14, 0, 11, 3, 8 ],
           [ 9, 14, 15, 5, 2, 8, 12, 3, 7, 0, 4, 10, 1, 13, 11, 6 ],
           [ 4, 3, 2, 12, 9, 5, 15, 10, 11, 14, 1, 7, 6, 0, 8, 13 ] ],
		  
         [ [ 4, 11, 2, 14, 15, 0, 8, 13, 3, 12, 9, 7, 5, 10, 6, 1 ],
           [ 13, 0, 11, 7, 4, 9, 1, 10, 14, 3, 5, 12, 2, 15, 8, 6 ],
           [ 1, 4, 11, 13, 12, 3, 7, 14, 10, 15, 6, 8, 0, 5, 9, 2 ],
           [ 6, 11, 13, 8, 1, 4, 10, 7, 9, 5, 0, 15, 14, 2, 3, 12 ] ],
		  
         [ [ 13, 2, 8, 4, 6, 15, 11, 1, 10, 9, 3, 14, 5, 0, 12, 7 ],
           [ 1, 15, 13, 8, 10, 3, 7, 4, 12, 5, 6, 11, 0, 14, 9, 2 ],
           [ 7, 11, 4, 1, 9, 12, 14, 2, 0, 6, 10, 13, 15, 3, 5, 8 ],
           [ 2, 1, 14, 7, 4, 10, 8, 13, 15, 12, 9, 0, 3, 5, 6, 11 ] ] ];
				  
$shiftBits = [ 1, 1, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 1 ];
 
function hextoBin($hexDec)
{
	$bin = "";
    $i = 0;
    while(strlen($hexDec[$i])){		
        switch($hexDec[$i]){
			case '0':
				$bin .= "0000";
				break;
			case '1':
				$bin .= "0001";
				break;
			case '2':
				$bin .= "0010";
				break;
			case '3':
				$bin .= "0011";
				break;
			case '4':
				$bin .= "0100";
				break;
			case '5':
				$bin .= "0101";
				break;
			case '6':
				$bin .= "0110";
				break;
			case '7':
				$bin .= "0111";
				break;
			case '8':
				$bin .= "1000";
				break;
			case '9':
				$bin .= "1001";
				break;
			case 'A':
			case 'a':
				$bin .= "1010";
				break;
			case 'B':
			case 'b':
				$bin .= "1011";
				break;
			case 'C':
			case 'c':
				$bin .= "1100";
				break;
			case 'D':
			case 'd':
				$bin .= "1101";
				break;
			case 'E':
			case 'e':
				$bin .= "1110";
				break;
			case 'F':
			case 'f':
				$bin .= "1111";
				break;
			default:
        }
        $i++;
    }
	return $bin;
}
function bintoHex($binDec){
	$hex = "";
    $i = 0;
	$temp = "";
	while($i<63){
		$temp = $binDec[$i].$binDec[$i+1].$binDec[$i+2].$binDec[$i+3];
		switch($temp){
			case "0000":
					$hex .= "0";
				break;
			case "0001":
					$hex .= "1";
				break;
			case "0010":
					$hex .= "2";
				break;
			case "0011":
					$hex .= "3";
				break;
			case "0100":
					$hex .= "4";
				break;
			case "0101":
					$hex .= "5";
				break;
			case "0110":
					$hex .= "6";
				break;
			case "0111":
					$hex .= "7";
				break;
			case "1000":
					$hex .= "8";
				break;
			case "1001":
					$hex .= "9";
				break;
			case "1010":
					$hex .= "A";
				break;
			case "1011":
					$hex .= "B";
				break;
			case "1100":
					$hex .= "C";
				break;
			case "1101":
					$hex .= "D";
				break;
			case "1110":
					$hex .= "E";
				break;
			case "1111":
					$hex .= "F";
				break;
		}
		$i += 4;
	}
	return $hex;
}
function dectoBin($decBin)
{
	$bin = "";
    $i = 0;
    switch($decBin){
		case '0':
			$bin .= "0000";
			break;
		case '1':
			$bin .= "0001";
			break;
		case '2':
			$bin .= "0010";
			break;
		case '3':
			$bin .= "0011";
			break;
		case '4':
			$bin .= "0100";
			break;
		case '5':
			$bin .= "0101";
			break;
		case '6':
			$bin .= "0110";
			break;
		case '7':
			$bin .= "0111";
			break;
		case '8':
			$bin .= "1000";
			break;
		case '9':
			$bin .= "1001";
			break;
		case '10':
			$bin .= "1010";
			break;
		case '11':
			$bin .= "1011";
			break;
		case '12':
			$bin .= "1100";
			break;
		case '13':
			$bin .= "1101";
			break;
		case '14':
			$bin .= "1110";
			break;
		case '15':
			$bin .= "1111";
			break;
		default:
			break;
    }
	return $bin;
}
function hex2str($hex) {
    $str = '';
    for($i=0;$i<strlen($hex);$i+=2) $str .= chr(hexdec(substr($hex,$i,2)));
    return $str;
}
function createIP($input){
	global $IP;
	$i = 0;
	$iR = 0;
	while($IP[$i]){
		if($i>31){
			$IPTableR[$iR] = $input[$IP[$i]-1];
			$iR++;
		}else{			
			$IPTableL[$i] = $input[$IP[$i]-1];
		}
		$i++;
	}
	$IPTable[0] = $IPTableL;
	$IPTable[1] = $IPTableR;
	return $IPTable;
}
function createIP1($input){
	global $IP1;
	$i = 0;
	while($IP1[$i]){		
		$IP1Table[$i] = $input[$IP1[$i]-1];		
		$i++;
	}
	return $IP1Table;
}
function createEPTable($input){
	global $EP;
	$i = 0;
	while($EP[$i]){	
		$EBit[$i] = $input[$EP[$i]-1];		
		$i++;
	}
	return $EBit;
}

function createPTable($input){
	global $P;
	$i = 0;
	while($P[$i]){	
		$PBit[$i] = $input[$P[$i]-1];		
		$i++;
	}
	return $PBit;
}

function _xor($text,$key){	
    for($i=0; $i<count($text); $i++){
        $text[$i] = intval($text[$i])^intval($key[$i]);
    }
    return $text;
}


function rotateLeft($d, $arr) {
    $remaining = array_slice($arr, $d);
    array_splice($arr, $d);
    return array_merge($remaining,$arr);
}

function generateKey($input){
	global $PC1,$PC2,$shiftBits;
	
	//PC1 Table
	$i = 0;
	$iR = 0;
	while($PC1[$i]){	
		if($i>27){
			$derivedKeyR[$iR] = $input[$PC1[$i]-1];
			$iR++;
		}else{
			$derivedKeyL[$i] = $input[$PC1[$i]-1];		
		}
		$i++;
	}
	
	$derivedKey[0] = $derivedKeyL;
	$derivedKey[1] = $derivedKeyR;
	
	$C1 = rotateLeft($shiftBits[0], $derivedKey[0]);
	$D1 = rotateLeft($shiftBits[0], $derivedKey[1]);
	
	$C2 = rotateLeft($shiftBits[1], $C1);
	$D2 = rotateLeft($shiftBits[1], $D1);
	
	$C3 = rotateLeft($shiftBits[2], $C2);
	$D3 = rotateLeft($shiftBits[2], $D2);
	
	$C4 = rotateLeft($shiftBits[3], $C3);
	$D4 = rotateLeft($shiftBits[3], $D3);
	
	$C5 = rotateLeft($shiftBits[4], $C4);
	$D5 = rotateLeft($shiftBits[4], $D4);
	
	$C6 = rotateLeft($shiftBits[5], $C5);
	$D6 = rotateLeft($shiftBits[5], $D5);
	
	$C7 = rotateLeft($shiftBits[6], $C6);
	$D7 = rotateLeft($shiftBits[6], $D6);
	
	$C8 = rotateLeft($shiftBits[7], $C7);
	$D8 = rotateLeft($shiftBits[7], $D7);
	
	$C9 = rotateLeft($shiftBits[8], $C8);
	$D9 = rotateLeft($shiftBits[8], $D8);
	
	$C10 = rotateLeft($shiftBits[9], $C9);
	$D10 = rotateLeft($shiftBits[9], $D9);
	
	$C11 = rotateLeft($shiftBits[10], $C10);
	$D11 = rotateLeft($shiftBits[10], $D10);
	
	$C12 = rotateLeft($shiftBits[11], $C11);
	$D12 = rotateLeft($shiftBits[11], $D11);
	
	$C13 = rotateLeft($shiftBits[12], $C12);
	$D13 = rotateLeft($shiftBits[12], $D12);
	
	$C14 = rotateLeft($shiftBits[13], $C13);
	$D14 = rotateLeft($shiftBits[13], $D13);
	
	$C15 = rotateLeft($shiftBits[14], $C14);
	$D15 = rotateLeft($shiftBits[14], $D14);
	
	$C16 = rotateLeft($shiftBits[15], $C15);
	$D16 = rotateLeft($shiftBits[15], $D15);
	
	$_key[0] = array_merge($C1,$D1);
	$_key[1] = array_merge($C2,$D2);
	$_key[2] = array_merge($C3,$D3);
	$_key[3] = array_merge($C4,$D4);
	$_key[4] = array_merge($C5,$D5);
	$_key[5] = array_merge($C6,$D6);
	$_key[6] = array_merge($C7,$D7);
	$_key[7] = array_merge($C8,$D8);
	$_key[8] = array_merge($C9,$D9);
	$_key[9] = array_merge($C10,$D10);
	$_key[10] = array_merge($C11,$D11);
	$_key[11] = array_merge($C12,$D12);
	$_key[12] = array_merge($C13,$D13);
	$_key[13] = array_merge($C14,$D14);
	$_key[14] = array_merge($C15,$D15);
	$_key[15] = array_merge($C16,$D16);
	
	$inc = 0;
	while($inc<16){
		//PC2 Table
		$i = 0;
		while($PC2[$i]){
			$keyR[$inc][$i] = $_key[$inc][$PC2[$i]-1];					
			$i++;
		}
		$inc += 1;
	}
	return $keyR;
}

function sBox($input){
	global $sbox;
	$i = 0;
	$s = 0;
	while($i<48){
		$row = bindec($input[$i].$input[$i+5]);		
		$column = bindec($input[$i+1].$input[$i+2].$input[$i+3].$input[$i+4]);		
		$temp .= dectoBin($sbox[$s][$row][$column]);		
		$i += 6;
		$s += 1;
	}
	return $temp;
}

function encryptionDes($plainText,$key){
	$plainText = hextoBin($plainText);
	$key = hextoBin($key);
	$keys = generateKey($key);
	var_dump($keys);
	$L[0] = createIP($plainText)[0];
	$R = createIP($plainText)[1];
	$L[1] = $R;

	/*First*/
	$ER = createEPTable($R);
	$K1xorER = _xor($ER,$keys[0]);

	$S1 = sBox($K1xorER);
	$F = createPTable($S1);

	$R = _xor($L[0],$F);
	$L[2] = $R;

	$j = 0;
	while($j<15){
		$ER = createEPTable($L[$j+2]);

		$K1xorER = _xor($ER,$keys[$j+1]);

		$S1 = sBox($K1xorER);

		$F = createPTable($S1);
		$R = _xor($L[$j+1],$F);
		$L[$j+3] = $R;
		$j += 1;
	}
	$chiperTextBinary = createIP1(array_merge($L[17],$L[16]));
	return bintoHex($chiperTextBinary);
}

function decryptionDes($chiperText,$key){
	$chiperText = hextoBin($chiperText);
	$key = hextoBin($key);
	$keys = generateKey($key);
	
	$L[0] = createIP($chiperText)[0];
	$R = createIP($chiperText)[1];
	$L[1] = $R;

	$j = 0;
	while($j<16){
		$ER = createEPTable($L[$j+1]);
		$K1xorER = _xor($ER,$keys[15-$j]);
		$S1 = sBox($K1xorER);
		$F = createPTable($S1);
		$R = _xor($L[$j],$F);
		$L[$j+2] = $R;
		$j +=1;
	}
	$plainTextBinary = createIP1(array_merge($L[17],$L[16]));
	return hex2str(bintoHex($plainTextBinary));
}
function strtoASCII($input){
	$temp = "";
	$i = 0;
	while(strlen($input)>$i){
		$temp .= strtoupper(dechex(ord($input[$i])));
		$i += 1;
	}
	return $temp;
}

$plainText = strtoASCII("2023000001");
$key = "6E61646131323334";
$chiperText = "67ED29B2F26CFA06EDDD621675E35B4E";
echo allTextDecrtptionDes($chiperText,$key);
function allTextEncryptionDes($str,$key){
	$i = 0;
	$temp1 = "";
	while(strlen($str)>$i){
		$temp = $str[$i].$str[$i+1].$str[$i+2].$str[$i+3].$str[$i+4].$str[$i+5].$str[$i+6].$str[$i+7].$str[$i+8].$str[$i+9].$str[$i+10].$str[$i+11].$str[$i+12].$str[$i+13].$str[$i+14].$str[$i+15];		
		$temp1 .= encryptionDes($temp,$key);
		$i += 16;
	}
	return $temp1;
}
function allTextDecrtptionDes($str,$key){
	$i = 0;
	$temp1 = "";
	while(strlen($str)>$i){
		$temp = $str[$i].$str[$i+1].$str[$i+2].$str[$i+3].$str[$i+4].$str[$i+5].$str[$i+6].$str[$i+7].$str[$i+8].$str[$i+9].$str[$i+10].$str[$i+11].$str[$i+12].$str[$i+13].$str[$i+14].$str[$i+15];		
		$temp1 .= decryptionDes($temp,$key);
		$i += 16;
	}
	return $temp1;
}


?>