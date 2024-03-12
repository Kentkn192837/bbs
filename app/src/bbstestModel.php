<?php
require_once('DbManager.php');

//名前,タイトル,本文の内容を取得
$name = ( isset( $_POST["name"] ) === true ) ? htmlspecialchars( $_POST["name"] ) : "名無し";
$comment = ( isset( $_POST["comment"] ) === true ) ? htmlspecialchars( $_POST["comment"] ) : "";

//エラーメッセージ
$err_msg1 = ""; //名前で使う
$err_msg2 = ""; //本文が入力されていない時に呼び出されるエラーメッセージ

$message = ""; //書き込みに成功した時に呼び出されるメッセージ

if (!isset($_POST["send"])) {
    return;
}

if ( $name === "") $name = "名無し";
if ( $comment  === "" ) $err_msg2 = "本文を入力してください";

$name = trim( $name );
$comment = trim( $comment );

if ( mb_strlen($name, "UTF-8") > 20 ) $err_msg1 = "名前は20文字以内にしてください";
if ( mb_strlen($comment, "UTF-8") > 300 ) $err_msg2 = "本文は300文字以内にしてください";

if ( $err_msg1 === "" && $err_msg2 === "" ) {
    try
    {
        $date = date("Y-m-d H:i:s");
        $pdo = getDB();
        $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);

        $stt = $pdo->prepare('INSERT INTO test(name, comment, date) VALUES(:name, :comment, :date)');
        $stt->bindValue(':name', $name);
        $stt->bindValue(':comment', $comment);
        $stt->bindValue(':date', $date);
        $stt->execute();

        //$message = "<p>書き込みに成功しました。</p>";
    }
    catch (PDOException $e)
    {
        $message = "<p>接続エラー: " . $e->getMessage() . "</p>";
        die();
    }
    finally
    {
        $pdo = null;
    }
}

//コメントを格納する変数
$res = array();

try
{
    $pdo = getDB();
    $stt = $pdo->prepare('SELECT name, comment, date FROM test');
    $stt->execute();

    //内容を出力
    $i = 1;
    while ( $row = $stt->fetch(PDO::FETCH_ASSOC) ) {
        $row["name"]    = htmlspecialchars( $row["name"], ENT_QUOTES, 'UTF-8' );
        $row["comment"] = htmlspecialchars( $row["comment"], ENT_QUOTES, 'UTF-8' );
        $row["date"]    = htmlspecialchars( $row["date"], ENT_QUOTES, 'UTF-8' );

        $res[$i] = "<p>{$i}:{$row["name"]} {$row["date"]}<br>{$row["comment"]}</p>";
        $i++;
    }
}
catch (PDOException $e)
{
    $message = "<p>接続エラー: " . $e->getMessage() . "</p>";
    die();
}
finally
{
    $pdo = null;
}

?>
