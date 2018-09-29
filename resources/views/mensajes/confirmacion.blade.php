<div class="modal fade" tabindex="-1" role="dialog" id="modal-confirmacion">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @yield('modal-confirmacion-title')
            </div>
            <div class="modal-body">
                @yield('modal-confirmacion-body')
            </div>
            <div class="modal-footer">
                @yield('modal-confirmacion-footer')
            </div>
        </div>
    </div>
</div>