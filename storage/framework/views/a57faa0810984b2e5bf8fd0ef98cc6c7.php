<?php if (! $__env->hasRenderedOnce('87b8d5ed-bc7c-47d5-927e-11b094555b1a')): $__env->markAsRenderedOnce('87b8d5ed-bc7c-47d5-927e-11b094555b1a');
$__env->startPush(config('pagebuilder.site_style_var')); ?>
    <style>
        iframe {
            width: 100% !important;
            height: 100% !important;
        }
        .google_map{
            height: 200px;
        }
    </style>
<?php $__env->stopPush(); endif; ?>
<div class="contacts_info mt-5">
    <p><?php echo pagesetting('google_map_editor'); ?></p>
    <div class="google_map w-100">
        <?php echo pagesetting('google_map_key'); ?>

    </div>
</div>
<?php /**PATH /Users/amityadav/www/laravel/shane_schoolspros/resources/views/themes/edulia/pagebuilder/google-map/view.blade.php ENDPATH**/ ?>