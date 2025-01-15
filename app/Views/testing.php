<td class="table-action">
    <a href="<?= site_url('logAdmin/edit/' . $value->id_log_user) ?>" class="action-icon"> <i class="mdi mdi-pencil btn btn-warning mb-2 text-white"></i></a>
    <form action="<?= site_url('logAdmin/delete/' . $value->id_log_user) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
        <!--csrf disini kalau ditambahkan-->
        <button class="action-icon" style="background: none; border: none;">
            <i class="mdi mdi-delete btn btn-danger mb-2"></i>
        </button>
    </form>
</td>