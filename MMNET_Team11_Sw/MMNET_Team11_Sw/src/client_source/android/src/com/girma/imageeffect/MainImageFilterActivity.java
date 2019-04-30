package com.girma.imageeffect;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileOutputStream;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.provider.MediaStore.Images;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ImageView;
import android.widget.Toast;

import com.girma.imageretriver.ImageLoader;
import com.google.zxing.client.android.R;

/**
 * Image filtering activity handler 
 */
public class MainImageFilterActivity extends Activity {

	private ImageView imgMain;
	private static final int SELECT_PHOTO = 100;
	private static Bitmap src;
	String image_url;
	String current_filter_type;
	ImageLoader imgLoader;
	int loader;
   /**
    * Oncreate method to handle the main image filter activity 
    */
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
				WindowManager.LayoutParams.FLAG_FULLSCREEN);
		setContentView(R.layout.activity_main_intent_filter);
		loader = R.drawable.loader;
		imgMain = (ImageView) findViewById(R.id.effect_main);
		image_url = getIntent().getExtras().getString("uri");
		imgLoader = new ImageLoader(getApplicationContext());
		src = imgLoader.DisplayImage(image_url, loader, imgMain);

	}
    /**
     * 
     * @param v
     * button event handler function 
     */
	public void buttonClicked(View v) {

		Toast.makeText(this, "Processing...", Toast.LENGTH_SHORT).show();
		ImageFilters imgFilter = new ImageFilters();

		src = imgLoader.DisplayImage(image_url, loader, imgMain);

		if (v.getId() == R.id.btn_pick_img) {

			Intent sharingIntent = new Intent(Intent.ACTION_SEND);
			image_url = getIntent().getExtras().getString("uri");
			imgMain.setImageBitmap(src);
			sharingIntent.setType("text/plain");
			sharingIntent.putExtra(Intent.EXTRA_TEXT, image_url);

			startActivity(Intent.createChooser(sharingIntent,
					"Send image using.."));
		} else if (v.getId() == R.id.effect_black) {
			saveBitmap(imgFilter.applyBlackFilter(src), "effect_black");
			current_filter_type = "effect_black";
		} else if (v.getId() == R.id.effect_boost_1) {
			saveBitmap(imgFilter.applyBoostEffect(src, 1, 40), "effect_boost_1");
			current_filter_type = "effect_boost_1";
		} else if (v.getId() == R.id.effect_boost_2) {
			saveBitmap(imgFilter.applyBoostEffect(src, 2, 30), "effect_boost_2");
			current_filter_type = "effect_boost_2";
		} else if (v.getId() == R.id.effect_boost_3) {
			saveBitmap(imgFilter.applyBoostEffect(src, 3, 67), "effect_boost_3");
			current_filter_type = "effect_boost_3";
		} else if (v.getId() == R.id.effect_brightness) {
			saveBitmap(imgFilter.applyBrightnessEffect(src, 80),
					"effect_brightness");
			current_filter_type = "effect_brightness";
		} else if (v.getId() == R.id.effect_color_red) {
			saveBitmap(imgFilter.applyColorFilterEffect(src, 255, 0, 0),
					"effect_color_red");
			current_filter_type = "effect_color_red";
		} else if (v.getId() == R.id.effect_color_green) {
			saveBitmap(imgFilter.applyColorFilterEffect(src, 0, 255, 0),
					"effect_color_green");
			current_filter_type = "effect_color_green";
		} else if (v.getId() == R.id.effect_color_blue) {
			saveBitmap(imgFilter.applyColorFilterEffect(src, 0, 0, 255),
					"effect_color_blue");
			current_filter_type = "effect_color_blue";
		} else if (v.getId() == R.id.effect_color_depth_64) {
			saveBitmap(imgFilter.applyDecreaseColorDepthEffect(src, 64),
					"effect_color_depth_64");
			current_filter_type = "effect_color_depth_64";
		} else if (v.getId() == R.id.effect_color_depth_32) {
			saveBitmap(imgFilter.applyDecreaseColorDepthEffect(src, 32),
					"effect_color_depth_32");
			current_filter_type = "effect_color_depth_32";
		} else if (v.getId() == R.id.effect_contrast) {
			saveBitmap(imgFilter.applyContrastEffect(src, 70),
					"effect_contrast");
			current_filter_type = "effect_contrast";
		} else if (v.getId() == R.id.effect_emboss) {
			saveBitmap(imgFilter.applyEmbossEffect(src), "effect_emboss");
			current_filter_type = "effect_emboss";
		} else if (v.getId() == R.id.effect_engrave) {
			saveBitmap(imgFilter.applyEngraveEffect(src), "effect_engrave");
			current_filter_type = "effect_engrave";
		} else if (v.getId() == R.id.effect_flea) {
			saveBitmap(imgFilter.applyFleaEffect(src), "effect_flea");
			current_filter_type = "effect_flea";
		} else if (v.getId() == R.id.effect_gaussian_blue) {
			saveBitmap(imgFilter.applyGaussianBlurEffect(src),
					"effect_gaussian_blue");
			current_filter_type = "effect_gaussian_blue";
		} else if (v.getId() == R.id.effect_gamma) {
			saveBitmap(imgFilter.applyGammaEffect(src, 1.8, 1.8, 1.8),
					"effect_gamma");
			current_filter_type = "effect_gamma";
		} else if (v.getId() == R.id.effect_grayscale) {
			saveBitmap(imgFilter.applyGreyscaleEffect(src), "effect_grayscale");
			current_filter_type = "effect_grayscale";
		} else if (v.getId() == R.id.effect_hue) {
			saveBitmap(imgFilter.applyHueFilter(src, 2), "effect_hue");
			current_filter_type = "effect_hue";
		} else if (v.getId() == R.id.effect_invert) {
			saveBitmap(imgFilter.applyInvertEffect(src), "effect_invert");
			current_filter_type = "effect_invert";
		} else if (v.getId() == R.id.effect_mean_remove) {
			saveBitmap(imgFilter.applyMeanRemovalEffect(src),
					"effect_mean_remove");
			current_filter_type = "effect_mean_remove";
		}

		else if (v.getId() == R.id.effect_round_corner) {
			saveBitmap(imgFilter.applyRoundCornerEffect(src, 45),
					"effect_round_corner");
			current_filter_type = "effect_round_corner";
		} else if (v.getId() == R.id.effect_saturation) {
			saveBitmap(imgFilter.applySaturationFilter(src, 1),
					"effect_saturation");
			current_filter_type = "effect_saturation";
		} else if (v.getId() == R.id.effect_sepia) {
			saveBitmap(
					imgFilter.applySepiaToningEffect(src, 10, 1.5, 0.6, 0.12),
					"effect_sepia");
			current_filter_type = "effect_sepia";
		} else if (v.getId() == R.id.effect_sepia_green) {
			saveBitmap(
					imgFilter.applySepiaToningEffect(src, 10, 0.88, 2.45, 1.43),
					"effect_sepia_green");
			current_filter_type = "effect_sepia_green";
		} else if (v.getId() == R.id.effect_sepia_blue) {
			saveBitmap(
					imgFilter.applySepiaToningEffect(src, 10, 1.2, 0.87, 2.1),
					"effect_sepia_blue");
			current_filter_type = "effect_sepia_blue";
		} else if (v.getId() == R.id.effect_smooth) {
			saveBitmap(imgFilter.applySmoothEffect(src, 100), "effect_smooth");
			current_filter_type = "effect_smooth";
		} else if (v.getId() == R.id.effect_sheding_cyan) {
			saveBitmap(imgFilter.applyShadingFilter(src, Color.CYAN),
					"effect_sheding_cyan");
			current_filter_type = "effect_sheding_cyan";
		} else if (v.getId() == R.id.effect_sheding_yellow) {
			saveBitmap(imgFilter.applyShadingFilter(src, Color.YELLOW),
					"effect_sheding_yellow");
			current_filter_type = "effect_sheding_yellow";
		} else if (v.getId() == R.id.effect_sheding_green) {
			saveBitmap(imgFilter.applyShadingFilter(src, Color.GREEN),
					"effect_sheding_green");
			current_filter_type = "effect_sheding_green";
		} else if (v.getId() == R.id.effect_tint) {
			saveBitmap(imgFilter.applyTintEffect(src, 100), "effect_tint");
			current_filter_type = "effect_tint";
		} else if (v.getId() == R.id.effect_watermark) {
			saveBitmap(imgFilter.applyWaterMarkEffect(src, "kpbird.com", 200,
					200, Color.GREEN, 80, 24, false), "effect_watermark");
			current_filter_type = "effect_watermark";
		}

	}
    /**
     * 
     * @param bmp
     * @param fileName
     */
	private void saveBitmap(Bitmap bmp, String fileName) {
		try {
			imgMain.setImageBitmap(bmp);
			File f = new File(Environment.getExternalStorageDirectory()
					.getAbsolutePath() + "/" + fileName + ".png");
			FileOutputStream fos = new FileOutputStream(f);
			bmp.compress(Bitmap.CompressFormat.PNG, 90, fos);
		} catch (Exception ex) {
			ex.printStackTrace();
		}
	}
    /**
     * function to handle result form another actvity 
     */
	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		switch (requestCode) {
		case SELECT_PHOTO:
			if (resultCode == RESULT_OK) {
				Uri selectedImage = data.getData();
				Bitmap bmp = decodeUri(selectedImage);
				if (bmp != null) {
					src = bmp;
					imgMain.setImageBitmap(src);
				}
			}
		}
	}
    /**
     * function to retrieve image for a given URI 
     * @param selectedImage
     * @return
     */
	private Bitmap decodeUri(Uri selectedImage) {

		try {

			// Decode image size
			BitmapFactory.Options o = new BitmapFactory.Options();
			o.inJustDecodeBounds = true;
			BitmapFactory.decodeStream(
					getContentResolver().openInputStream(selectedImage), null,
					o);

			// The new size we want to scale to
			final int REQUIRED_SIZE = 400;

			// Find the correct scale value. It should be the power of 2.
			int width_tmp = o.outWidth, height_tmp = o.outHeight;
			int scale = 1;
			while (true) {
				if (width_tmp / 2 < REQUIRED_SIZE
						|| height_tmp / 2 < REQUIRED_SIZE) {
					break;
				}
				width_tmp /= 2;
				height_tmp /= 2;
				scale *= 2;
			}

			// Decode with inSampleSize
			BitmapFactory.Options o2 = new BitmapFactory.Options();
			o2.inSampleSize = scale;
			return BitmapFactory.decodeStream(getContentResolver()
					.openInputStream(selectedImage), null, o2);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return null;
	}
   /**
    * Function to handle activity on resum situation 
    */
	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();

		// TODO Auto-generated method stub
		loader = R.drawable.loader;
		imgMain = (ImageView) findViewById(R.id.effect_main);
		image_url = getIntent().getExtras().getString("uri");
		imgLoader = new ImageLoader(getApplicationContext());

		src = imgLoader.DisplayImage(image_url, loader, imgMain);
	}

	/**
	 * 
	 * @param inContext
	 * @param inImage
	 * @return
	 */

	public Uri getImageUri(Context inContext, Bitmap inImage) {
		ByteArrayOutputStream bytes = new ByteArrayOutputStream();
		src = imgLoader.DisplayImage(image_url, loader, imgMain);
		src.compress(Bitmap.CompressFormat.PNG, 90, bytes);
		String path = Images.Media.insertImage(inContext.getContentResolver(),
				inImage, "Title", null);
		return Uri.parse(path);
	}
    /**
     * to get real path of the image
     * @param uri
     * @return
     */
	public String getRealPathFromURI(Uri uri) {
		Cursor cursor = getContentResolver().query(uri, null, null, null, null);
		cursor.moveToFirst();
		int idx = cursor.getColumnIndex(MediaStore.Images.ImageColumns.DATA);
		return cursor.getString(idx);
	}
}
