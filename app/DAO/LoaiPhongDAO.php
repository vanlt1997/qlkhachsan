<?php
namespace App\DAO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LoaiPhongDAO {

	public function filterByName($name) {
		$result = DB::table('LoaiPhong')->where('LoaiPhong.TenLoai', 'like', '%' . $name . '%');
		return $result;
	}

	public function getById($id) {
		// $result = DB::table('Phong');
		$result = DB::table('LoaiPhong');
			// ->join('Phong', 'LoaiPhong.MaLoai', '=', 'Phong.MaLoai')
			// ->join('TrangThai', 'Phong.MaTT', '=', 'TrangThai.MaTT');
		if ($id != "") {
			$result = $result->where('LoaiPhong.MaLoai', '=', $id);
		}
		return $result->select()->orderBy('LoaiPhong.MaLoai', 'desc');//select('field');
	}

	// public static function timKiemPhong($maLoai) {
	// 	if ($maLoai == null || $maLoai == '') {
	// 		$phongs = DB::table('LoaiPhong')
	// 			->join('Phong', 'Phong.MaLoai', '=', 'LoaiPhong.MaLoai')
	// 			->leftjoin('Phong_DatPhong', 'Phong.MaPhong', '=', 'Phong_DatPhong.MaPhong')
	// 			->where('Phong.MaTT', '<', '3')
	// 			->select('Phong.MaPhong as MaPhong', 'TenLoai', 'Giuong', 'NguoiLon', 'TreCon', 'DienTich', 'MaTT', 'TenPhong', 'NgayDen', 'NgayDi', 'Phong.MoTa as MoTa', 'GiuongPhu', 'Phong.Image as Image', 'Phong.DonGia')
	// 			->get();
	// 	} else {
	// 		$phongs = DB::table('LoaiPhong')
	// 			->join('Phong', 'Phong.MaLoai', '=', 'LoaiPhong.MaLoai')
	// 			->leftjoin('Phong_DatPhong', 'Phong.MaPhong', '=', 'Phong_DatPhong.MaPhong')
	// 			->where('Phong.MaTT', '<', '3')
	// 			->where('LoaiPhong.MaLoai', '=', $maLoai)
	// 			->select('Phong.MaPhong as MaPhong', 'TenLoai', 'Giuong', 'NguoiLon', 'TreCon', 'DienTich', 'MaTT', 'TenPhong', 'NgayDen', 'NgayDi', 'Phong.MoTa as MoTa', 'GiuongPhu', 'Phong.Image as Image', 'Phong.DonGia')
	// 			->get();
	// 	}

	// 	return $phongs;
	// }
	public static function getPhongByLoai($maLoai) {
		$listTB = DB::table('LoaiPhong')
			->join('Phong', 'Phong.MaLoai', '=', 'LoaiPhong.MaLoai')
			->where('LoaiPhong.MaLoai', $maLoai)
			->get();
		return $listTB;
	}
	public static function image($arr) {
		return $listLoai = explode(",", $arr);
	}

	public static function paginate($items, $perPage = 10, $page = null, $options = []) {
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
		$items = $items instanceof Collection ? $items : Collection::make($items);
		return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
	}
}
?>