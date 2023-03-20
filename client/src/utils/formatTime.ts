import { format, getTime, formatDistanceToNow } from "date-fns";

// ----------------------------------------------------------------------

export function fDate(date: Date | string, newFormat: string) {
  const fm = newFormat || "dd MMM yyyy";

  return date ? format(new Date(date), fm) : "";
}

export function fDateTime(
  date: Date | string,
  newFormat: string = "dd MMM yyyy p"
) {
  return date ? format(new Date(date), newFormat) : "";
}

export function fTimestamp(date: Date | string) {
  return date ? getTime(new Date(date)) : "";
}

export function fToNow(date: Date | string) {
  return date
    ? formatDistanceToNow(new Date(date), {
        addSuffix: true,
      })
    : "";
}
