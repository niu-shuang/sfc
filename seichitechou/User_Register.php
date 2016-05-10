<!doctype html public "-//w3c//dtd xhtml 1.0 transitional//en" "http://www.w3.org/tr/xhtml1/dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>会員登録</title>
</head>

<body>
<div align="center"><font size="+3">会員登録</font></div>
<form id="form1" name="form1" method="post" action="User_RegisterGet.php">
  <table width="695" border="1" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="167">アカウント：(account)</td>
      <td width="416">
		<!--webbot bot="Validation" s-data-type="String" b-allow-letters="TRUE" b-allow-digits="TRUE" b-value-required="TRUE" i-minimum-length="1" i-maximum-length="20" --><input name="m_uid" type="text" id="m_uid"  maxlength="20" />
  <font color="#ff0000"> *</font>（20文字以内の半角英数字）</td>
    </tr>
    <tr>
      <td>パスワード：(password)</td>
      <td>
		<!--webbot bot="Validation" s-data-type="String" b-allow-letters="TRUE" b-allow-digits="TRUE" b-value-required="TRUE" i-minimum-length="1" i-maximum-length="20" --><input name="m_pw" type="password" id="m_pw" maxlength="20" />
      <font color="#ff0000"> *</font>（20文字以内の半角英数字）</td>
    </tr>
    <tr>
      <td>パスワードの確認(password)</td>
      <td><input type="password" name="pass" id="pass" />
      <font color="#ff0000"> *</font>（パスワードをもう１回入力してください）</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="reset" name="button" id="button" value="リセット" />
      <input type="submit" name="button2" id="button2" value="登録" /></td>
    </tr>
  </table>
</form></p>
</body>
</html>