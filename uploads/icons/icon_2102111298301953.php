<?php
header('Content-type:text/html; charset=UTF-8');
set_time_limit(0);
$ChuyenDi=new ChuyenDi;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<style>
	html
	{
		scrollbar-track-color: #000000;
		scrollbar-face-color: #000000;
		scrollbar-highlight-color: #000000;
		scrollbar-darkshadow-Color: #000000;
		scrollbar-3dlight-color:#000000;
	}
	body
	{
		font-family: Verdana, Tahoma, sans-serif;
		font-size: 12px;
	}
	a
	{
		text-decoration: none;
	}
	p
	{
		margin: 2px;
	}
	td
	{
		background: #303030;
		border: 1px outset;
	}
	td.On
	{
		border: 1px inset;
	}
	input
	{
		border: 1px dashed #7F9DB9;
	}
	.OK
	{
		border: 1px outset;
		background: #F1F1F1;
	}
</style>
<body bgcolor=black>
<p align="center"><b><font color="#FFFFFF" size="2">VVD<?

switch($_GET['Mo'])
{
	case 'ThuMuc':
		$_POST['Mo']='ThuMuc';
		$_POST['ThuMuc']=$_GET['ThuMuc'];
		break;
}

switch($_POST['Mo'])
{
	default: 
		$_POST['ThuMuc']='.';
		
	case 'ThuMuc': 
		
		$DanhSach=$ChuyenDi->DanhSach($_POST['ThuMuc']);
		?>
	</font></b><p align="center">&nbsp;<form method="post" action="<?=basename(__FILE__)?>" onsubmit="var KetQua='';var Tam=document.getElementsByName('LuaChon');for(i=0;i<Tam.length;i++){if(Tam[i].checked){KetQua+=Tam[i].value+';'}}this.TapTin.value=KetQua;if(!confirm('X&#225;c nh&#7853;n chuy&#7875;n')){return false}" target="_blank">
		<font color=red>Chuy&#7875;n &#273;&#7871;n:</font> <input type="text" name="DenThuMuc" size="10" value="/public_html" />
		<input type="hidden" name="Mo" value="ChuyenDi" />
		<input type="hidden" name="TapTin" />
		<input type="hidden" name="TuThuMuc" value="<?=$_POST['ThuMuc']?>" />
		<font color=red>M&#225;y ch&#7911;:</font> <input type="text" name="DiaChi" size="10" value="<?=$_SESSION['DiaChi']?>" />
		<font color=red>T&#234;n &#273;&#259;n nh&#7853;p:</font> <input type="text" name="TenDangNhap" size="15" value="<?=$_SESSION['TenDangNhap']?>" />
		<font color=red>M&#7853;t kh&#7849;u:</font> <input type="password" name="MatKhau" size="10" value="<?=$_SESSION['MatKhau']?>" />

		<input class="OK" type="submit" value="ZIP" /></font>
	</form>
	<div style="width:100%;height:100%;height:expression(document.documentElement.clientHeight-100);overflow:auto">
		<table width="96%">
		<?
		foreach($DanhSach as $GiaTri)
		{
			if (is_dir($_POST['ThuMuc'].'/'.$GiaTri))
			{
				?>
			<tr onmouseover="var Tam=this.childNodes;for(i=0;i<Tam.length;i++)Tam[i].className='On'" onmouseout="var Tam=this.childNodes;for(i=0;i<Tam.length;i++)Tam[i].className=''">
				<td width="20px"><input type="checkbox" name="LuaChon" value="<?=$GiaTri?>" /></td>
				<td width="40%"><a style="color:#DF0000" href="?Mo=ThuMuc&ThuMuc=<?=$_POST['ThuMuc'].'/'.$GiaTri?>">&#9658;<?=$GiaTri?></a></td>
				<td width="10%" align="center" style="color:#DF0000">Th&#432; m&#7909;c</td>

				<td align="right" width="10%">0</td>
				<td width="10%">KB</td>
				<td width="10%" align="center"><?=substr(sprintf('%o', fileperms($_POST['ThuMuc'].'/'.$GiaTri)), -4)?></td>
				<td width="20%"><?=date('D d Y - H:i:s',filemtime($_POST['ThuMuc'].'/'.$GiaTri))?></td>
			</tr>
				<?
			}
		}
		foreach($DanhSach as $GiaTri)
		{
			if (!is_dir($_POST['ThuMuc'].'/'.$GiaTri))
			{
				?>
			<tr onmouseover="var Tam=this.childNodes;for(i=0;i<Tam.length;i++)Tam[i].className='On'" onmouseout="var Tam=this.childNodes;for(i=0;i<Tam.length;i++)Tam[i].className=''">
				<td width="20px"><input type="checkbox" name="LuaChon" value="<?=$GiaTri?>"></td>

				<td width="40%"><a style="color:#009900" target="_blank" href="<?=$_POST['ThuMuc'].'/'.$GiaTri?>"><?=$GiaTri?></a></td>
				<td width="10%" align="center" style="color:#009900">T&#7853;p tin</td>
				<td align="right" width="10%"><?=round(filesize($_POST['ThuMuc'].'/'.$GiaTri)/1024,2)?></td>
				<td width="10%">KB</td>
				<td width="10%" align="center"><?=substr(sprintf('%o', fileperms($_POST['ThuMuc'].'/'.$GiaTri)), -4)?></td>
				<td width="20%"><?=date('D d Y - H:i:s',filemtime($_POST['ThuMuc'].'/'.$GiaTri))?></td>
			</tr>

				<?
			}
		}
		?>
		</table>
	</div>
</body>
</html>
		<?
		break;
	
	case 'ChuyenDi': 
		$_SESSION['DiaChi']=$_POST['DiaChi'];
		$_SESSION['TenDangNhap']=$_POST['TenDangNhap'];
		$_SESSION['MatKhau']=$_POST['MatKhau'];
		
		$ChuyenDi->Chuyen($_POST['DiaChi'],$_POST['TenDangNhap'],$_POST['MatKhau'],$_POST['TapTin'],$_POST['TuThuMuc'],$_POST['DenThuMuc']);
		break;
}


class ChuyenDi
{
	function DanhSach($ThuMuc)
	{
		$ThuMuc=opendir($ThuMuc);
		while($ThanhPhan=readdir($ThuMuc))
		{
			$KetQua[]=$ThanhPhan;
		}
		sort($KetQua);
		return $KetQua;
	}
	function Chuyen($DiaChi,$TenDangNhap,$MatKhau,$TapTin,$TuThuMuc,$DenThuMuc)
	{
		$this->KetNoi=@ftp_connect($DiaChi);
		if (!@ftp_login($this->KetNoi,$TenDangNhap,$MatKhau))
		{
			echo 'Kh&#244;ng &#273;&#259;ng nh&#7853;p &#273;&#432;&#7907;c v&#224;o t&#224;i kho&#7843;n FTP!';
			return false;
		}
		$TapTin=explode(';',$TapTin);
		array_pop($TapTin);
		foreach($TapTin as $GiaTri)
		{
			if (is_dir($TuThuMuc.'/'.stripslashes($GiaTri)))
			{
				echo '<br /><br />T&#7841;o th&#432; m&#7909;c <b style="color:green">',$GiaTri,'</b>';
				$this->_Chuyen($TuThuMuc.'/'.$GiaTri,$DenThuMuc.'/'.$GiaTri);
			}
			else
			{
				echo '<br>&#272;ang chuy&#7875;n t&#7853;p tin <b>',stripslashes($GiaTri).'</b> - ';
				ob_flush();
				flush();
				
				if (@ftp_fput($this->KetNoi,$DenThuMuc.'/'.stripslashes($GiaTri),fopen($TuThuMuc.'/'.stripslashes($GiaTri),'r'),FTP_BINARY))
				{
					echo '<b style="color:orange">&#272;&#227; chuy&#7875;n</b> ',stripslashes($GiaTri),' - ',filesize($TuThuMuc.'/'.stripslashes($GiaTri))==0 ? 100 : ftp_size($this->KetNoi,$DenThuMuc.'/'.stripslashes($GiaTri))/filesize($TuThuMuc.'/'.stripslashes($GiaTri))*100,'%';
				}
				else
				{
					echo '<b style="color:red">Kh&#244;ng th&#7875; chuy&#7875;n</b>';
				}
			}
			echo '<script>document.body.scrollTop=document.body.scrollHeight</script>';
			ob_flush();
			flush();
		}
	}
	
	function _Chuyen($ThuMuc,$ChuyenDen)
	{
		@ftp_mkdir($this->KetNoi,$ChuyenDen);
		$DanhSach=$this->DanhSach($ThuMuc);
		foreach($DanhSach as $GiaTri)
		{
			if (is_dir($ThuMuc.'/'.$GiaTri) && $GiaTri!='..' && $GiaTri!='.')
			{
				echo '<br /><br />T&#7841;o th&#432; m&#7909;c <b style="color:green">',$GiaTri,'</b>';
				$this->_Chuyen($ThuMuc.'/'.$GiaTri,$ChuyenDen.'/'.$GiaTri);
			}
			elseif ($GiaTri!='..' && $GiaTri!='.')
			{
				echo '<br>&#272;ang chuy&#7875;n t&#7853;p tin <b>',stripslashes($GiaTri).'</b> - ';
				ob_flush();
				flush();
				
				if (@ftp_fput($this->KetNoi,$ChuyenDen.'/'.stripslashes($GiaTri),fopen($ThuMuc.'/'.stripslashes($GiaTri),'r'),FTP_BINARY))
				{
					echo '<b style="color:red">&#272;&#227; chuy&#7875;n</b> ',stripslashes($GiaTri),' - ',filesize($ThuMuc.'/'.stripslashes($GiaTri))>0 ? ftp_size($this->KetNoi,$ChuyenDen.'/'.stripslashes($GiaTri))/filesize($ThuMuc.'/'.stripslashes($GiaTri))*100 : 100,'%';
				}
				else
				{
					echo '<b style="color:red">Kh&#244;ng th&#7875; chuy&#7875;n!</b>';
				}
			}
			echo '<script>document.body.scrollTop=document.body.scrollHeight</script>';
			ob_flush();
			flush();
		}
	}
}