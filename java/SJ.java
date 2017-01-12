import java.util.ArrayList;
import java.util.List;
import java.util.StringJoiner;

class  SJ
{
	public static void main(String[] args) 
	{
		
		StringJoiner sj = new StringJoiner("\n");
		sj.add("George");
		sj.add("Sally");
		sj.add("Fred");
		String desiredString = sj.toString();
		System.out.println(desiredString);
		

		List<String> where = new ArrayList<String>();
		where.add("맹구");
		where.add("배용준");
		where.add("땡칠이");
		where.add("장동건");
		where.add("강수정");
		where.add("송창식");
		where.add("황당해");
		where.add("고은아");

		String[] names = new String[ where.size() ];
		where.toArray( names );

         System.out.println(strJoin(names,","));

		List<String> list = new ArrayList<String>();
		list.add("foo");
		list.add("bar");
		list.add("baz");
		list.add("baasdz");
		
		String joined = String.join(", ", list); 
		// "foo and bar and baz"
		System.out.println(joined);


	}

	public static String strJoin(String[] aArr, String sSep) {
    StringBuilder sbStr = new StringBuilder();
    for (int i = 0, il = aArr.length; i < il; i++) {
        if (i > 0)
            sbStr.append(sSep);
        sbStr.append(aArr[i]);
    }
    return sbStr.toString();
	}
}
