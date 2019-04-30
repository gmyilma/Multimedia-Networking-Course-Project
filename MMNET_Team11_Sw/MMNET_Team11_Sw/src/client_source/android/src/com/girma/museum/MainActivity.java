package com.girma.museum;



import com.google.zxing.client.android.R;
import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;

/**
 * Main activity of the application
 * @author Girma
 *
 */
public class MainActivity extends Activity {
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.main);
		setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
		
		Button scan = (Button) findViewById(R.id.btn_qr_scan);
		Button about = (Button) findViewById(R.id.btn_about);
		
		scan.setOnClickListener(new OnClickListener() {
			/**
			 * Button event handling for scanning QR-Code
			 */
			@Override
			public void onClick(View arg0) {
				// TODO Auto-generated method stub
				
				Intent scanIntent = new Intent(getApplicationContext(), 
						com.google.zxing.client.android.CaptureActivity.class);
				startActivity(scanIntent);
			}
		});
		/**
		 * Button event handling for displaying the about message 
		 */
		about.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				
				Intent aboutIntent = new  Intent(getApplicationContext(), About.class);
				startActivity(aboutIntent);
			}
		});
	}
	
}
