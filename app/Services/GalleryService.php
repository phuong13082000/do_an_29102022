<?php

namespace App\Services;

use App\Models\Gallery;

class GalleryService
{
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function selectGallery($request)
    {
        $productId = $request['pro_id'];
        $galleries = Gallery::where('product_id', $productId)->get();
        $galleryCount = $galleries->count();

        $output = '<form>
                   ' . csrf_field() . '
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>';
        if ($galleryCount > 0) {
            $i = 0;
            foreach ($galleries as $gallery) {
                $i++;
                $output .= '<tr>
                                <td>' . $i . '</td>
                                <td contenteditable class="edit_gall_name" data-gall_id="' . $gallery->id . '">' . $gallery->title . '</td>
                                <td>
                                    <img src="' . url('uploads/gallery/' . $gallery->image) . '" alt="' . $gallery->title . '" class="img-thumbnail" width="120" height="120">
                                    <input type="file" class="file_image" style="width: 40%" data-gall_id="' . $gallery->id . '" id="file-' . $gallery->id . '" name="file" accept="image/*">
                                </td>
                                <td><button type="button" class="delete_gall" data-gall_id="' . $gallery->id . '" class="btn btn-xs btn-danger">Delete</button></td>
                             </tr>';
            }
        } else {
            $output .= '<tr>
                            <td colspan="4">Chưa có thư viện ảnh</td>
                      </tr>';
        }
        $output .= '</tbody>
                 </table>
               </form>';

        echo $output;
    }

    public function insertGallery($request, $id)
    {
        $get_image = $request->file('file');

        if ($get_image) {
            foreach ($get_image as $image) {
                $new_image = $this->imageService->saveImageGallery($image);

                $gallery = new Gallery();
                $gallery->title = $new_image;
                $gallery->image = $new_image;
                $gallery->product_id = $id;
                $gallery->save();
            }
        }
    }

    public function updateNameGallery($request)
    {
        $gallery = Gallery::find($request['gall_id']);
        $gallery->title = $request['gall_text'];
        $gallery->save();
    }

    public function updateGallery($request)
    {
        $get_image = $request->file('file');

        if ($get_image) {
            $new_image = $this->imageService->saveImageGallery($get_image);

            $gallery = Gallery::find($request['gall_id']);
            unlink('../public/uploads/gallery/' . $gallery->title);

            $gallery->title = $new_image;
            $gallery->image = $new_image;
            $gallery->save();

        }
    }

    public function deleteGallery($request)
    {
        $gallery = Gallery::find($request['gall_id']);
        unlink('../public/uploads/gallery/' . $gallery->title);
        $gallery->delete();
    }
}
