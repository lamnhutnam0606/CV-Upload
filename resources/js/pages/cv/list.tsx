type CV = {
    file_path: string,
    original_name: string,
    mine_type: string,
    size: number,
    email: string,

}

export default function List() {
    return (
        <>
            <div className="p-6">
                <h1 className="text-xl font-semibold mb-4">
                    CV List
                </h1>

                <div className="overflow-x-auto">
                    <table className="w-full border border-gray-200">
                        <thead className="bg-black-100">
                            <tr>
                                <th className="p-2 border">#</th>
                                <th className="p-2 border">Full name</th>
                                <th className="p-2 border">Email</th>
                                <th className="p-2 border">File</th>
                                <th className="p-2 border">AI status</th>
                                <th className="p-2 border">Created at</th>
                            </tr>
                        </thead>

                        <tbody>
                            {/* {cvs.length === 0 && (
                                <tr>
                                    <td
                                        colSpan={6}
                                        className="p-4 text-center text-gray-500"
                                    >
                                        No CV found
                                    </td>
                                </tr>
                            )} */}

                            {/* {cvs.map((cv, index) => ( */}
                                <tr className="hover:bg-gray-50">
                                    <td className="p-2 border text-center">
                                        
                                    </td>

                                    <td className="p-2 border">
                                        
                                    </td>

                                    <td className="p-2 border">
                                       
                                    </td>

                                    <td className="p-2 border">
                                        <a
                                            href='#'
                                            target="_blank"
                                            className="text-blue-600 underline"
                                        >
                                           
                                        </a>
                                    </td>

                                    <td className="p-2 border">
                                        
                                    </td>

                                    <td className="p-2 border">
                                       
                                    </td>
                                </tr>
                            {/* ))} */}
                        </tbody>
                    </table>
                </div>
            </div>
        </>
    )
}