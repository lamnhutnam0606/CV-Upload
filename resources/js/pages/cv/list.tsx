import AppLayout from "@/layouts/app-layout";
import { formatDate } from "@/utils/format-date";

type CV = {
    full_name: string,
    email: string,
    phone: string,
    summary: string,
    created_at: string,
}

interface Props {
    cvs: CV[]
}

export default function List({cvs}: Props) {
    return (
        <AppLayout>
            <div className="p-6">
                <h1 className="text-xl font-semibold mb-4">
                    CV List
                </h1>

                <div className="overflow-x-auto">
                    <table className="w-full border border-gray-200">
                        <thead className="bg-black-100">
                            <tr>
                                <th className="p-2 border">No#</th>
                                <th className="p-2 border">Full name</th>
                                <th className="p-2 border">Email</th>
                                <th className="p-2 border">Phone</th>
                                <th className="p-2 border">Created at</th>
                                <th className="p-2 border">Summary</th>
                            </tr>
                        </thead>

                        <tbody>
                            {cvs.length === 0 && (
                                <tr>
                                    <td
                                        colSpan={6}
                                        className="p-4 text-center text-white-500"
                                    >
                                        No CV found
                                    </td>
                                </tr>
                            )}

                            {cvs.map((cv, index) => (
                                <tr className="hover:bg-gray-50 hover:text-black">
                                    <td className="p-2 border text-center">
                                        {index + 1}
                                    </td>

                                    <td className="p-2 border">
                                        {cv.full_name}
                                    </td>

                                    <td className="p-2 border">
                                        {cv.email}
                                    </td>

                                    <td className="p-2 border">
                                        {cv.phone}
                                    </td>

                                    <td className="p-2 border">
                                        {formatDate(cv.created_at)}
                                    </td>

                                    <td className="p-2 border text-center">
                                        <button
                                            // onClick={() => window.open(cv.file_path, '_blank')}
                                            className="px-2 py-1 text-sm text-blue-600 bg-gray-50 border border-blue-600 rounded hover:bg-green-50"
                                        >
                                            Preview
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
            </AppLayout>
    )
}