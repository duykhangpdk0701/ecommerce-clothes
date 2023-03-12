import type { NextRequest } from "next/server";

export async function middleware(request: NextRequest) {
  // const getIndentify = await userAPI.getUserDetail();
  // return NextResponse.redirect(new URL("/auth/login", request.url));
}

export const config = {
  matcher: "/admin/:paht*",
};
