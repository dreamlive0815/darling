package com.baidu.trace.demo;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.concurrent.ExecutionException;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.concurrent.atomic.AtomicLong;

import com.baidu.trace.LBSTraceClient;
import com.baidu.trace.api.track.AddPointRequest;
import com.baidu.trace.api.track.AddPointsRequest;
import com.baidu.trace.api.track.UploadResponse;
import com.baidu.trace.model.CoordType;
import com.baidu.trace.model.LatLng;
import com.baidu.trace.model.OnUploadListener;
import com.baidu.trace.model.TrackPoint;

public class Main {
	
	public static Calendar getTime(int y, int m, int d, int h, int mi, int s)
	{
		Calendar c = Calendar.getInstance();
		c.set(y, m, d, h, mi, s);
		return c;
	}

    private static AtomicLong mSequenceGenerator = new AtomicLong();

    private static AtomicInteger successCounter = new AtomicInteger();

    private static AtomicInteger failedCounter = new AtomicInteger();
    

    public static void main(String[] args) throws Exception {
        LBSTraceClient client = LBSTraceClient.getInstance();
        client.init();
        client.start();

        client.registerUploadListener(new OnUploadListener() {

            @Override
            public void onSuccess(long responseId) {
                //System.out.println("上传成功 : " + responseId + ", successCounter : " + successCounter.incrementAndGet());
            }

            @Override
            public void onFailed(UploadResponse response) {
                System.err.println("上传失败 : " + response.getResponseID() + ", failedCounter : "
                        + failedCounter.incrementAndGet() + ", " + response);
            }
        });
        
        String ak = "ejPRYNRicLYxjma9G6gsnI8o6DSXfGKT";
        int service_id = 164674;

        List<TrackPoint> trackPoints = new ArrayList<TrackPoint>();
        //121.449224,31.206533
        //121.517711,31.230621
        //7km
        
        //116.280949,39.913939
        //116.55116,39.915267
        /*
        for (int i = 1; i <= 50; ++i) {
            TrackPoint trackPoint = new TrackPoint(new LatLng(40.05 + i / 100.0, 116.31), CoordType.bd09ll, 30,
                    System.currentTimeMillis() / 1000 - i * 60, 4, 20, 40, null, null);
            trackPoints.add(trackPoint);
        }
        */
        
        Info info = new Info(new Loc(121.449224, 31.206533), getTime(2018, 5, 1, 10, 0, 0));
        info.setEnd(new Loc(121.531581, 31.235808));
        //info.start = new Loc(116.280949, 39.913939);
        //info.end = new Loc(116.55116, 39.915267);     
        info.setEndTime(getTime(2018, 5, 1, 12, 0, 0));
        
        info.addPoints(trackPoints, 50);
        info.setEnd(new Loc(121.550625, 31.225526));
        info.addPoints(trackPoints, 20);
        String name = "darling" + new SimpleDateFormat("yyyyMMddHHmmss").format(new Date());
        for (int i = 0; i < 70; i++) {
        	//Map<String, List<TrackPoint>> trackPointMap = new HashMap<String, List<TrackPoint>>();
            //trackPointMap.put(name, trackPoints);
        	TrackPoint point = trackPoints.get(i);
        	point.setLocTime(System.currentTimeMillis() / 1000 - i * 60);
            AddPointRequest request = new AddPointRequest(mSequenceGenerator.incrementAndGet(),
                    ak, service_id, name, trackPoints.get(i));
            // 批量添加轨迹点
            client.addPoint(request);
        }

        // AddPointRequest request1 = new AddPointRequest(100,
        // "4NEAN17DpkroLCVwZPg21EIQ0KsxGt3E", 137062,
        // "batch_upload_1", trackPoints.get(0));
        // instance.addPoint(request1);
        //
        // AddPointsRequest request2 = new AddPointsRequest(101,
        // "4NEAN17DpkroLCVwZPg21EIQ0KsxGt3E", 137062,
        // trackPointMap);
        // instance.addPoints(request2);

    }

}

class Loc
{
	public double longitude;
	public double latitude;
	
	public Loc(double a, double b)
	{
		longitude = a;
		latitude = b;
	}
}

class Info
{
	public long UNSET_LONG = 0;
	private Loc start;
	private Loc end;
	
	public Info(Loc start, Calendar init)
	{
		startTime = init.getTimeInMillis() / 1000;
		this.start = start;
	}
	
	public void setEnd(Loc end)
	{
		if(this.end != null) {
			this.start = this.end;
		}
		this.end = end;
	}
	
	public void setEndTime(Calendar end)
	{
		if(endTime != UNSET_LONG) {
			startTime = endTime;
		}
		endTime = end.getTimeInMillis() / 1000;
	}
	
	public void addPoints(List<TrackPoint> list, int count) throws Exception
    {
		if(start == null || end == null || endTime == UNSET_LONG || count < 2) throw new Exception("Bad Args");
    	
    	double plo = (end.longitude - start.longitude) / (count - 1);
    	double pla = (end.latitude - start.latitude) / (count - 1);
    	double pt = (endTime - startTime) * 1.0 / (count - 1);
    	for(int i = 0; i < count; i++) {
    		
    		list.add(new TrackPoint(new LatLng(start.latitude + pla * i, start.longitude + plo * i), CoordType.bd09ll, 30,
                    (long)(startTime + pt * i), 4, 20, 40, null, null));
    		//list.get(i).setLocation(new LatLng(start.latitude + pla * i, start.longitude + plo * i));
    	}
    	
    }
	
	private long startTime;
	private long endTime = UNSET_LONG;
}
